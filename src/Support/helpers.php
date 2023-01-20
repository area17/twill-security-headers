<?php

use A17\TwillSecurityHeaders\Services\Helpers;
use A17\TwillSecurityHeaders\Services\TwillSecurityHeaders;

if (!function_exists('security_headers')) {
    function security_headers(): TwillSecurityHeaders
    {
        return Helpers::instance();
    }
}

if (!function_exists('csp_nonce')) {
    function csp_nonce(): string
    {
        return Helpers::nounce();
    }
}
