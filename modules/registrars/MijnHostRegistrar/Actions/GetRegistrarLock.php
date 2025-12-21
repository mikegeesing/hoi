<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Clients\MijnHostClient;
use WHMCS\Database\Capsule;

class GetRegistrarLock extends AbstractAction
{
    function execute(): string
    {
        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $domainInfo = $client->getDomain($this->params['domain_punycode']);

        if($_POST['sub'] == "autorenew")
        {
            if($_POST['autorenew'] == "enable" && $domainInfo->data->status == "Cancelled")
            {
                $client->cancelDeleteDomain($this->params['domain_punycode']);
            }
            else if($_POST['autorenew'] == "disable" && $domainInfo->data->status != "Cancelled")
            {
                $client->cancelDomain($this->params['domain_punycode']);
            }
        }
        else
        {
            $domain = Capsule::table('tbldomains')
                ->where('id', '=', $this->params['domainid'])
                ->first();

            $doNotRenew = $domainInfo->data->status == "Cancelled";

            if($doNotRenew != (bool) $domain->donotrenew)
            {
                $request = [
                    'domainid' => $this->params['domainid'],
                    'donotrenew' => $domainInfo->data->status == "Cancelled"
                ];

                $resultUpdateClientDomain = localAPI('UpdateClientDomain', $request);

                if($resultUpdateClientDomain['result'] != 'success')
                {
                    \logModuleCall(
                        'mijn.host', 'UpdateClientDomain',
                        print_r($request, true),
                        $resultUpdateClientDomain['message'],
                        $resultUpdateClientDomain['message']
                    );
                }

                header('Location: clientarea.php?action=domaindetails&id=' . $this->params['domainid']);
                exit();
            }
        }

        return $domainInfo->data->is_locked ? 'locked' : 'unlocked';
    }
}