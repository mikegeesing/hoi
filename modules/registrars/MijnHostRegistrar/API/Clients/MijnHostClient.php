<?php

namespace ModulesGarden\MijnHostRegistrar\API\Clients;

use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Exceptions\AccessDeniedException;
use Psr\Http\Message\ResponseInterface;

class MijnHostClient
{
    protected MijnHostAdapter $adapter;

    public function __construct(MijnHostAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    protected function response(ResponseInterface $response, bool $ignoreBadRequest = false): \stdClass
    {
        if(($response->getStatusCode() !== 200  && !$ignoreBadRequest) || ($response->getStatusCode() !== 200 && $response->getStatusCode() !== 400 && $ignoreBadRequest))
        {
            throw new \Exception('mijn.host API error');
        }

        $responseClass = json_decode($response->getBody());

        if(!$responseClass)
        {
            throw new \Exception('mijn.host API error');
        }

        return $responseClass;
    }

    public function getDomain(string $domain, bool $ignoreAccessDenied = false): \stdClass
    {
        $response = $this->adapter->get('/api/v2/domains/' . $domain);

        $responseClass = $this->response($response, $ignoreAccessDenied);

        if($responseClass->status == 400 && $responseClass->status_description == 'You have no access to this resource.')
        {
            throw new AccessDeniedException();
        }

        return $this->response($response);
    }

    public function updateDomain(string $domain, array $options = []): \stdClass
    {
        return $this->response($this->adapter->put('/api/v2/domains/' . $domain, $options));
    }

    public function cancelDomain(string $domain): \stdClass
    {
        return $this->response($this->adapter->delete('/api/v2/domains/' . $domain));
    }

    public function cancelDeleteDomain(string $domain): \stdClass
    {
        return $this->response($this->adapter->put('/api/v2/domains/' . $domain . '/cancel-delete'));
    }

    public function listProfilesContacts(): \stdClass
    {
        return $this->response($this->adapter->get('/api/v2/domains/contacts'));
    }

    public function listProfilesNameservers(): \stdClass
    {
        return $this->response($this->adapter->get('/api/v2/domains/nameservers'));
    }

    public function getDnsRecords(string $domain): \stdClass
    {
        return $this->response($this->adapter->get('/api/v2/domains/' . $domain . '/dns'));
    }

    public function updateDnsRecords(string $domain, array $dnsRecords): \stdClass
    {
        return $this->response($this->adapter->put('/api/v2/domains/' . $domain . '/dns', [
            'records' => $dnsRecords
        ]));
    }

    public function getAuthCode(string $domain): \stdClass
    {
        return $this->response($this->adapter->get('/api/v2/domains/' . $domain . '/auth-code'));
    }

    public function orderDomain(array $options = []): \stdClass
    {
        return $this->response($this->adapter->post('/api/v2/domains/order', $options));
    }

    public function createProfileNameservers(array $options = []): \stdClass
    {
        return $this->response($this->adapter->post('/api/v2/domains/nameservers', $options));
    }

    public function createProfileContact(array $options = []): \stdClass
    {
        return $this->response($this->adapter->post('/api/v2/domains/contacts', $options));
    }
}