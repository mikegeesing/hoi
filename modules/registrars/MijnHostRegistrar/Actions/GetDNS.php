<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Clients\MijnHostClient;

class GetDNS extends AbstractAction
{

    function execute(): array
    {
        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $dnsInfo = $client->getDnsRecords($this->params['domain_punycode']);

        $dnsRecords = [];

        foreach($dnsInfo->data->records as $dnsRecord)
        {
            if($dnsRecord->type == 'MX')
            {
                [$priority, $address] = explode(' ', $dnsRecord->value);

                $dnsRecords[] = [
                    'hostname' => $dnsRecord->name,
                    'type' => $dnsRecord->type,
                    'address' => $address,
                    'priority' => $priority
                ];

                continue;
            }

            $dnsRecords[] = [
                'hostname' => $dnsRecord->name,
                'type' => $dnsRecord->type,
                'address' => $dnsRecord->value,
                'priority' => null
            ];
        }

        return $dnsRecords;
    }
}