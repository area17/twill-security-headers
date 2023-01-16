<?php

namespace A17\TwillSecurityHeaders\Services;

use A17\TwillSecurityHeaders\Support\TwillSecurityHeaders;

class Helpers
{
    public static function load(): void
    {
        require __DIR__ . '/../Support/helpers.php';
    }

    public static function instance(): TwillSecurityHeaders
    {
        if (!app()->bound('security-headers')) {
            app()->singleton('security-headers', fn() => new TwillSecurityHeaders());
        }

        return app('security-headers');
    }
}
