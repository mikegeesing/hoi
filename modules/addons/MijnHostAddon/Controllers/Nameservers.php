<?php

namespace ModulesGarden\MijnHostAddon\Controllers;

use ModulesGarden\MijnHostAddon\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostAddon\API\Clients\MijnHostClient;
use ModulesGarden\MijnHostAddon\Helpers\Lang;

class Nameservers extends AbstractController
{
    public function index(): array
    {
        $adapter = new MijnHostAdapter($this->params['apiKey']);
        $client = new MijnHostClient($adapter);

        $nameserversProfiles = $client->listProfilesNameservers();

        $nameserversProfilesArray = [];

        foreach($nameserversProfiles->data->nameservers as $profile)
        {
            if(!empty($nameserversProfilesArray[$profile->alias]))
            {
                continue;
            }

            foreach($profile->nameservers as $nameserver)
            {
                $nameserversProfilesArray[$profile->alias][] = $nameserver->hostname;
            }

            while(count($nameserversProfilesArray[$profile->alias]) < 6)
            {
                $nameserversProfilesArray[$profile->alias][] = "";
            }
        }

        $lang = new Lang();

        $error = $_SESSION['MijnHost_Error'] ?? null;
        unset($_SESSION['MijnHost_Error']);

        return [
            'pagetitle' => 'Nameservers',
            'breadcrumb' => [
                'clientarea.php' => 'Client Area',
                'index.php?m=MijnHostAddon&mha-controller=nameservers' => $lang->get('primaryNavbarNameserverProfiles')
            ],
            'templatefile' => 'nameservers',
            'requirelogin' => true,
            'vars' => [
                'lang' => $lang,
                'nameserverProfiles' => $nameserversProfilesArray,
                'error' => $error
            ]
        ];
    }

    public function createNameserverProfile(): void
    {
        $profileName = $_POST['createNewProfileProfileName'];
        $nameservers = $_POST['createNewProfileNameservers'];

        $adapter = new MijnHostAdapter($this->params['apiKey']);
        $client = new MijnHostClient($adapter);

        $completedNameservers = [];

        foreach($nameservers as $nameserver)
        {
            if(!empty($nameserver))
            {
                $ipv4 = $this->resolveIp($nameserver, 'ipv4');
                $ipv6 = $this->resolveIp($nameserver, 'ipv6');

                $completedNameservers[] = [
                    'hostname' => $nameserver,
                    'ipv4' => $ipv4,
                    'ipv6' => empty($ipv6) ? "" : $ipv6,
                ];
            }
        }

        try
        {
            $client->createProfileNameservers([
                'alias' => $profileName,
                'nameservers' => $completedNameservers
            ]);
        }
        catch(\Exception $e)
        {
            $_SESSION['MijnHost_Error'] = $e->getMessage();
        }

        header('Location: index.php?m=MijnHostAddon&mha-controller=Nameservers');
        exit();

    }

    public function updateNameserverProfile(): void
    {
        $profileName = $_POST['manageProfilesSelect'];
        $nameservers = $_POST['updateProfileNameservers'];

        $adapter = new MijnHostAdapter($this->params['apiKey']);
        $client = new MijnHostClient($adapter);

        $completedNameservers = [];

        foreach($nameservers as $nameserver)
        {
            if(!empty($nameserver))
            {
                $ipv4 = $this->resolveIp($nameserver, 'ipv4');
                $ipv6 = $this->resolveIp($nameserver, 'ipv6');

                $completedNameservers[] = [
                    'hostname' => $nameserver,
                    'ipv4' => $ipv4,
                    'ipv6' => empty($ipv6) ? "" : $ipv6,
                ];
            }
        }

        try
        {
            $client->updateProfileNameserver($profileName, [
                'nameservers' => $completedNameservers
            ]);
        }
        catch(\Exception $e)
        {
            $_SESSION['MijnHost_Error'] = $e->getMessage();
        }

        header('Location: index.php?m=MijnHostAddon&mha-controller=Nameservers');
        exit();
    }

    protected function resolveIp(string $fqdn, string $type): ?string
    {
        $records = dns_get_record($fqdn, $type == 'ipv4' ? DNS_A : DNS_AAAA);

        foreach($records as $record)
        {
            if(empty($record))
            {
                continue;
            }

            $ip = $type == 'ipv4' ? $record['ip'] : $record['ipv6'];

            if(empty($ip))
            {
                continue;
            }

            return $ip;
        }

        return null;
    }
}