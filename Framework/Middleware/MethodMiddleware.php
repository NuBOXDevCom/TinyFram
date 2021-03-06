<?php

namespace Framework\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MethodMiddleware implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $next
     * @return ResponseInterface|null
     * @throws \InvalidArgumentException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $next): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        if (array_key_exists('_method', $parsedBody) && \in_array($parsedBody['_method'], ['DELETE', 'PUT'], true)) {
            $request = $request->withMethod($parsedBody['_method']);
        }
        return $next->handle($request);
    }
}
