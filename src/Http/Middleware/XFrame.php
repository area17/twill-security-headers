<?php

namespace A17\TwillSecurityHeaders\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use A17\SecurityHeaders\SecurityHeaders;

class XFrame extends Middleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        return $this->middleware($request, $next, 'x-frame');
    }
}
