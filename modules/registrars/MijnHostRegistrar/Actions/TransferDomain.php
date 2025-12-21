<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

use libphonenumber\PhoneNumberUtil;
use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Clients\MijnHostClient;
use DateTime;

class TransferDomain extends AbstractAction
{

    function execute(): array
    {
        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $profileName = (new DateTime())->format('His') . '-' . str_replace('.', '-', $this->params['domain']);

        $nameservers = [
            $this->params['ns1'],
            $this->params['ns2'],
            $this->params['ns3'],
            $this->params['ns4'],
            $this->params['ns5']
        ];

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

        $client->createProfileNameservers([
            'alias' => $profileName,
            'nameservers' => $completedNameservers
        ]);

        $fullPhoneNumber = str_replace('.', "", $this->params['adminfullphonenumber']);

        $util = PhoneNumberUtil::getInstance();
        $proto = $util->parse($fullPhoneNumber, null);

        $nsn = $util->getNationalSignificantNumber($proto);
        $ndcLength = $util->getLengthOfNationalDestinationCode($proto);

        $areaCode = substr($nsn, 0, $ndcLength);
        $subscriber = substr($nsn, $ndcLength);

        $address = $this->splitAddress($this->params['adminaddress1']);

        $contactResult = $client->createProfileContact([
            'name' => $profileName,
            'profile' => [
                'company' => $this->params['admincompanyname'],
                'firstname' => $this->params['adminfirstname'],
                'lastname' => $this->params['adminlastname'],
                'street' => $address['street'],
                'street_number' => $address['number'],
                'street_suffix' => $address['suffix'],
                'zipcode' => $this->params['adminpostcode'],
                'city' => $this->params['admincity'],
                'state' => $this->params['adminfullstate'],
                'country' => $this->params['admincountry'],
                'phone_country' => '+' . $this->params['adminphonecc'],
                'phone_area' => $areaCode,
                'phone_number' => $subscriber,
                'email' => $this->params['adminemail']
            ]
        ]);

        $orderDomainResult = $client->orderDomain([
            'domain' => $this->params['domain_punycode'],
            'type' => 'transfer',
            'transfer_code' => $this->params['eppcode'],
            'nameserver' => $profileName,
            'profile' => [
                'owner' => $contactResult->data->id,
                'admin' => $contactResult->data->id,
                'tech' => $contactResult->data->id,
                'billing' => $contactResult->data->id,
            ]
        ]);

        return [
            'success' => true,
        ];
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

    protected function splitAddress(string $input): array {
        $s = trim(preg_replace('/\s+/u', ' ', $input));

        if (preg_match('/^\s*(.*\D)\s+(\d+)\s*([\p{L}\d\-\/]*)\s*$/u', $s, $m)) {
            $street = trim($m[1]);
            $number = $m[2];
            $suffix = $m[3];

            // normalize suffix
            $suffix = ltrim($suffix);
            // remove leading dash if present (e.g. "-2" → "2")
            $suffix = ltrim($suffix, '-');

            if ($suffix === '' && preg_match('/^(\d+)\s*([A-Za-z\-\/].*)$/u', $number, $mm)) {
                $number = $mm[1];
                $suffix = ltrim($mm[2], '-');
            }

            return compact('street','number','suffix');
        }

        // number-first fallback
        if (preg_match('/^\s*(\d+)([A-Za-z]?)\s+(.+)\s*$/u', $s, $m)) {
            $number = $m[1];
            $suffix = ltrim($m[2], '-');
            $street = trim($m[3]);
            return compact('street','number','suffix');
        }

        // generic fallback
        if (preg_match('/^(.*?)(\d+)\s*([\p{L}\d\-\/]*)\s*$/u', $s, $m)) {
            return [
                'street' => trim($m[1]),
                'number' => $m[2],
                'suffix' => ltrim($m[3], '-'),
            ];
        }

        return ['street' => $s, 'number' => '', 'suffix' => ''];
    }
}