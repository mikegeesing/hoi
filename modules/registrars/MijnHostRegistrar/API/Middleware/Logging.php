<?php

namespace ModulesGarden\MijnHostRegistrar\API\Middleware;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Logging
{
    public function __invoke(callable $handler): \Closure
    {
        return function (RequestInterface $request, array $options) use ($handler): PromiseInterface {
            return $handler($request, $options)->then(function (ResponseInterface $response) use ($request) {
                $this->log($request, $response);

                return $response;
            });
        };
    }

    protected function log(RequestInterface $request, ResponseInterface $response): void
    {
        $action = $request->getRequestTarget();
        $requestAsString = $this->getRequestAsString($request);
        $responseAsString = $response instanceof \Exception ? $response->getMessage() : $this->getResponseAsString($response);

        \logModuleCall('mijn.host', $action, $requestAsString, $responseAsString, $responseAsString);
    }

    protected function getRequestAsString(RequestInterface $request): string
    {
        $requestAsString = $request->getMethod() . ' ' . $request->getRequestTarget() . " HTTP/" . $request->getProtocolVersion() . "\r\n";

        foreach($request->getHeaders() as $name => $value)
        {
            $requestAsString .= $name . ": " . implode(', ', $value) . "\r\n";
        }

        $requestAsString .= "\r\n";
        $requestAsString .= $request->getBody();

        return $requestAsString;
    }

    protected function getResponseAsString(ResponseInterface $response): string
    {
        $responseAsString = "HTTP/" . $response->getProtocolVersion() . " " . $response->getStatusCode() . " " . $response->getReasonPhrase() . "\r\n";

        foreach($response->getHeaders() as $name => $value)
        {
            $responseAsString .= $name . ": " . implode(', ', $value) . "\r\n";
        }

        $responseAsString .= "\r\n";
        $responseAsString .= $response->getBody();

        return $responseAsString;
    }
}