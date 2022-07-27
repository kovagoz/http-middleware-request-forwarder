<?php

namespace Test;

use Kovagoz\Http\Middleware\RequestForwarder\RequestForwarder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestHandler implements RequestHandlerInterface
{
    use TestHelper;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $handlerMethod = $request->getAttribute('__handler');

        if ($handlerMethod === null) {
            throw new \RuntimeException('No handler method defined');
        }

        if (!method_exists($this, $handlerMethod)) {
            throw new \RuntimeException('Handler method does not exist');
        }

        return $this->$handlerMethod();
    }

    /**
     * Returns with a simple HTML response
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function foo(): ResponseInterface
    {
        return $this->createResponse('foo');
    }

    /**
     * Returns response with a forward header
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function bar(): ResponseInterface
    {
        return $this->createResponse('bar')
            ->withHeader(RequestForwarder::RESPONSE_HEADER, 'foo');
    }
}
