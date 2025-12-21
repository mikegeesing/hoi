<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Clients\MijnHostClient;

class GetEPPCode extends AbstractAction
{

    function execute(): array
    {
        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $authCodeInfo = $client->getAuthCode($this->params['domain_punycode']);

        return [
            'eppcode' => $authCodeInfo->data->auth_code
        ];
    }
}