<?php

namespace ModulesGarden\MijnHostAddon\API\Clients;

use ModulesGarden\MijnHostAddon\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostAddon\API\Exceptions\AccessDeniedException;
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
            $responseClass = json_decode($response->getBody());

            if(!$responseClass || $response->getStatusCode() !== 400)
            {
                throw new \Exception('mijn.host API error');
            }

            throw new \Exception($responseClass->status_description);
        }

        $responseClass = json_decode($response->getBody());

        if(!$responseClass)
        {
            throw new \Exception('mijn.host API error');
        }

        return $responseClass;
    }

    public function listProfilesContacts(): \stdClass
    {
        return $this->response($this->adapter->get('/api/v2/domains/contacts'));
    }

    public function getProfileContacts(string $id): \stdClass
    {
        return $this->response($this->adapter->get('/api/v2/domains/contacts/' . $id));
    }

    public function createProfileContact(array $options = []): \stdClass
    {
        return $this->response($this->adapter->post('/api/v2/domains/contacts', $options));
    }

    public function updateProfileContact(string $id, array $options = []): \stdClass
    {
        return $this->response($this->adapter->put('/api/v2/domains/contacts/' . $id, $options));
    }

    public function listProfilesNameservers(): \stdClass
    {
        return $this->response($this->adapter->get('/api/v2/domains/nameservers'));
    }

    public function createProfileNameservers(array $options = []): \stdClass
    {
        return $this->response($this->adapter->post('/api/v2/domains/nameservers', $options));
    }

    public function updateProfileNameserver(string $alias, array $options = []): \stdClass
    {
        return $this->response($this->adapter->put('/api/v2/domains/nameservers/' . $alias, $options));
    }
}