<?php

namespace Kovagoz\Http\Middleware\RequestForwarder;

use Psr\Http\Message\ResponseInterface;

/**
 * An extension for the kovagoz/http-responder package.
 */
trait ResponseHelper
{
    /**
     * Create a new response object that has the forward header.
     *
     * @param string $handler
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function forward(string $handler): ResponseInterface
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->reply()->withHeader(RequestForwarder::RESPONSE_HEADER, $handler);
    }
}
