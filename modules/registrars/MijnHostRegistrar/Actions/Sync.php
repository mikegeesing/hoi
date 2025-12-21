<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Clients\MijnHostClient;
use ModulesGarden\MijnHostRegistrar\API\Exceptions\AccessDeniedException;

class Sync extends AbstractAction
{

    function execute(): array
    {
        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        try
        {
            $domainInfo = $client->getDomain($this->params['domain_punycode'], true);
        }
        catch(AccessDeniedException $e)
        {
            return [
                'expirydate' => null,
                'active' => false,
                'transferredAway' => true
            ];
        }

        $expiryDate = \DateTime::createFromFormat('d-m-Y', $domainInfo->data->renewal_date);

        return [
            'expirydate' => $expiryDate->format('Y-m-d'),
            'active' => $domainInfo->data->status == "active",
            'transferredAway' => false
        ];
    }
}