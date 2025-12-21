<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Clients\MijnHostClient;

class SaveRegistrarLock extends AbstractAction
{
    function execute(): array
    {
        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $client->updateDomain($this->params['domain_punycode'], [
            'is_locked' => $this->params['lockenabled'] == "locked"
        ]);

        return [
            'success' => 'success'
        ];
    }
}