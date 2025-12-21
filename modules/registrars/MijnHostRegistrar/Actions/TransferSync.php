<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Clients\MijnHostClient;

class TransferSync extends AbstractAction
{

    function execute(): array
    {
        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $domainInfo = $client->getDomain($this->params['domain_punycode']);

        if($domainInfo->data->status == "active")
        {
            return [
                'completed' => true
            ];
        }

        if($domainInfo->data->status == "pending_transfer")
        {
            return [];
        }

        return [
            'failed' => true
        ];
    }
}