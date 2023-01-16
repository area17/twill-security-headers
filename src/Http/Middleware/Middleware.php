<?php

namespace A17\TwillSecurityHeaders\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use A17\TwillSecurityHeaders\Support\Facades\TwillSecurityHeaders;

class Middleware
{
    protected string $type = '*';

    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        return TwillSecurityHeaders::middleware($response, $this->type);
    }

    public function middleware(Request $request, Closure $next, string $type = '*')
    {
        $this->setType($type);

        return $this->handle($request, $next);
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
