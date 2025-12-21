<?php

namespace ModulesGarden\MijnHostRegistrar\API\Adapters;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use ModulesGarden\MijnHostRegistrar\API\Middleware\Logging;

class MijnHostAdapter
{
    const BASE_URI = "https://mijn.host";

    protected Client $client;

    public function __construct(string $apiKey)
    {
        $handler = HandlerStack::create();
        $handler->push(new Logging());

        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'API-Key' => $apiKey,
            ],
            'handler' => $handler,
        ]);
    }

    public function get(string $endpoint, array $content = []): \Psr\Http\Message\ResponseInterface
    {
        return $this->request('GET', $endpoint, $content);
    }

    public function post(string $endpoint, array $content = []): \Psr\Http\Message\ResponseInterface
    {
        return $this->request('POST', $endpoint, $content);
    }

    public function put(string $endpoint, array $content = []): \Psr\Http\Message\ResponseInterface
    {
        return $this->request('PUT', $endpoint, $content);
    }

    public function delete(string $endpoint, array $content = []): \Psr\Http\Message\ResponseInterface
    {
        return $this->request('DELETE', $endpoint, $content);
    }

    protected function request(string $method, string $endpoint, array $content = []): \Psr\Http\Message\ResponseInterface
    {
        try
        {
            return $this->client->request($method, $endpoint, $content ? [
                'http_errors' => false,
                'json' => $content
            ] : [
                'http_errors' => false
            ]);
        }
        catch (\Exception $e)
        {
            throw new \Exception("mijn.host API error");
        }
    }
}