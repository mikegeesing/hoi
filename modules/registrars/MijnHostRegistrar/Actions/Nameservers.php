<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Clients\MijnHostClient;
use ModulesGarden\MijnHostRegistrar\Helpers\Lang;

class Nameservers extends AbstractAction
{
    function execute(): array
    {
        $action = $_GET['mhr-action'];

        if($action == "assignProfile" && !empty($_POST['assignProfileSelect']))
        {
            $this->assignProfile();
        }

        return $this->index();
    }

    protected function index(): array
    {
        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $domainInfo = $client->getDomain($this->params['domain_punycode']);
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
        }

        $currentNameservers = [];

        foreach($domainInfo->data->nameservers as $nameserver)
        {
            $currentNameservers[] = $nameserver;
        }

        return [
            'templatefile' => 'nameservers',
            'vars' => [
                'lang' => new Lang(),
                'domainId' => $this->params['domainid'],
                'nameserversProfiles' => $nameserversProfilesArray,
                'currentNameservers' => $currentNameservers,
            ]
        ];
    }

    protected function assignProfile()
    {
        $profile = $_POST['assignProfileSelect'];

        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $client->updateDomain($this->params['domain_punycode'], [
            'nameserver' => $profile
        ]);

        header('Location: clientarea.php?action=domaindetails&id=' . $this->params['domainid'] . '&modop=custom&a=Nameservers' . generate_token('link'));
        exit();
    }
}