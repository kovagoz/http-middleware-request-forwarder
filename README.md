# HTTP Request Forwarder

The aim of this library is to make it possible to pass the HTTP request to
another handler, creating a so-called internal redirect.

![phpunit workflow](https://github.com/kovagoz/http-middleware-request-forwarder/actions/workflows/php.yml/badge.svg)

## Requirements

* PHP >= 8.0

## Usage

Put this middleware into the stack before any request handler. If you want to
pass the request to another handler, then return a response from the current
handler with the `X-Internal-Redirect` header, and its value should be the
name of the target handler.

If you are using [PSR-17](https://www.php-fig.org/psr/psr-17/) factories,
the code will look like this:

```php
<?php

class SomeHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request)
    {
        return $this->responseFactory
            ->createResponse()
            ->withHeader('X-Internal-Redirect', AnotherHandler::class);
    }
}
```

If you are utilizing the [kovagoz/http-responder](https://github.com/kovagoz/http-responder)
library, then the `HttpResponder` extension found in this package can simplify
the forward process for you.

```php
<?php

// Extend the HttpResponder...
$responder = new class($responseFactory, $streamFactory) extends HttpResponder {
    use ResponseHelper;
};

// ...then call forward() in your handler.
return $responder->forward(AnotherHandler::class);

```
