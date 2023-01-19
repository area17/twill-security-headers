<?php

namespace A17\TwillSecurityHeaders\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use A17\TwillSecurityHeaders\Support\Facades\TwillSecurityHeaders;

abstract class Middleware
{
    protected string $type = '*';

    protected function handleRequest(Request $request, Closure $next): Response|RedirectResponse|JsonResponse
    {
        $response = $next($request);

        return TwillSecurityHeaders::middleware($response, $this->type);
    }

    protected function middleware(
        Request $request,
        Closure $next,
        string $type = '*',
    ): Response|RedirectResponse|JsonResponse {
        $this->setType($type);

        return $this->handleRequest($request, $next);
    }

    protected function setType(string $type): void
    {
        $this->type = $type;
    }
}
