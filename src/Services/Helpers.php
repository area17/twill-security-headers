<?php

namespace A17\TwillSecurityHeaders\Services;

use Illuminate\Support\Str;
use A17\TwillSecurityHeaders\Services\TwillSecurityHeaders;
use A17\TwillSecurityHeaders\Support\Facades\TwillSecurityHeaders as TwillSecurityHeadersFacade;

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

    public static function nounce(): string
    {
        return TwillSecurityHeadersFacade::nounce();
    }
}
