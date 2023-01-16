<?php

namespace A17\TwillSecurityHeaders\Support\Facades;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Facade;
use A17\TwillSecurityHeaders\Services\TwillSecurityHeaders as TwillSecurityHeadersService;

/**
 * @method static Response middleware(Response $response, string $type = '*')
 */
class TwillSecurityHeaders extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return TwillSecurityHeadersService::class;
    }
}
