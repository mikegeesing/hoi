<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Clients\MijnHostClient;

class SaveDNS extends AbstractAction
{

    function execute(): array
    {
        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $dnsRecords = [];

        foreach($this->params['dnsrecords'] as $dnsRecord)
        {
            $dnsRecords[] = [
                'type' => $dnsRecord['type'],
                'name' => $dnsRecord['hostname'],
                'value' => $dnsRecord['type'] == "MX" ? $dnsRecord['priority'] . " " . $dnsRecord['address'] : $dnsRecord['address'],
                'ttl' => 900
            ];
        }

        $client->updateDnsRecords($this->params['domain_punycode'], $dnsRecords);

        return [
            'success' => 'success',
        ];
    }
}