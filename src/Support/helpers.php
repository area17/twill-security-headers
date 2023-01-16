<?php

use A17\TwillSecurityHeaders\Services\Helpers;
use A17\TwillSecurityHeaders\Support\TwillSecurityHeaders;

if (!function_exists('security_headers')) {
    function security_headers(): TwillSecurityHeaders
    {
        return Helpers::instance();
    }
}
