<?php

namespace A17\TwillSecurityHeaders\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use A17\TwillSecurityHeaders\Support\Facades\TwillSecurityHeaders;

abstract class Middleware
{
    protected string $type = '*';

    protected function handleRequest(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        return TwillSecurityHeaders::middleware($response, $this->type);
    }

    protected function middleware(Request $request, Closure $next, string $type = '*')
    {
        $this->setType($type);

        return $this->handleRequest($request, $next);
    }

    protected function setType(string $type): void
    {
        $this->type = $type;
    }
}
