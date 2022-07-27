<?php

namespace Test;

use Kovagoz\Http\Middleware\RequestForwarder\RequestForwarder;
use PHPUnit\Framework\TestCase;

final class RequestForwarderTest extends TestCase
{
    use TestHelper;

    public function testResponseWithoutForward(): void
    {
        $request    = $this->createServerRequest('foo');
        $handler    = new RequestHandler();
        $middleware = new RequestForwarder();

        $response = $middleware->process($request, $handler);

        self::assertEquals('foo', (string) $response->getBody());
    }

    public function testResponseWithForward(): void
    {
        $request    = $this->createServerRequest('bar');
        $handler    = new RequestHandler();
        $middleware = new RequestForwarder();

        $response = $middleware->process($request, $handler);

        // Returns "foo" because response from bar has the forward header
        self::assertEquals('foo', (string) $response->getBody());
    }
}
