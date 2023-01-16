<?php

namespace A17\TwillSecurityHeaders\Http\Controllers;

use A17\TwillSecurityHeaders\Support\Facades\TwillSecurityHeaders;

class TwillSecurityHeadersFrontController
{
    public function securityHeaders()
    {
        return response(TwillSecurityHeaders::securityHeaders(), 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
