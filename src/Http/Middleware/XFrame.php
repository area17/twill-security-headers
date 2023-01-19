<?php

namespace A17\TwillSecurityHeaders\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class XFrame extends Middleware
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse|JsonResponse
    {
        return $this->middleware($request, $next, 'x-frame');
    }
}
