<?php

namespace Test;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

trait TestHelper
{
    private function createServerRequest(string $handler): ServerRequestInterface
    {
        return (new Psr17Factory())->createServerRequest('GET', '/')
            ->withAttribute('__handler', $handler);
    }

    private function createResponse(string $body = ''): ResponseInterface
    {
        $factory = new Psr17Factory();

        return $factory->createResponse()->withBody($factory->createStream($body));
    }
}
