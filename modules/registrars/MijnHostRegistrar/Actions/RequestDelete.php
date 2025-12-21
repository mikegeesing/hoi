<?php


namespace ModulesGarden\MijnHostRegistrar\Actions;

use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Clients\MijnHostClient;

class RequestDelete extends AbstractAction
{

    function execute(): array
    {
        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $client->cancelDomain($this->params['domain_punycode']);

        return [
            'success' => 'success',
        ];
    }
}