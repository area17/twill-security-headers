<?php

namespace A17\TwillSecurityHeaders\Services\Headers;

use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeader;
use A17\TwillSecurityHeaders\Repositories\TwillSecurityHeaderRepository;

class Header
{
    protected TwillSecurityHeader $securityHeaders;

    public function __construct()
    {
        $this->securityHeaders = $this->getModel();
    }

    public function setHeaders(Response|RedirectResponse|JsonResponse $response, array $header): void
    {
        if (!$this->enabled($header)) {
            return;
        }

        $responseHeader = $this->compileHeader($header);

        if (filled($responseHeader)) {
            $response->headers->set($header['header'], $responseHeader);
        }
    }

    protected function compileHeader(array $header): mixed
    {
        return $this->securityHeaders->{$this->snake($header['type'])};
    }

    public function getModel(): TwillSecurityHeader
    {
        return app(TwillSecurityHeaderRepository::class)->theOnlyOne();
    }

    protected function enabled(array $header): bool
    {
        return $this->securityHeaders->published &&
            $this->securityHeaders->{$this->snake($header['type']) . '_enabled'};
    }

    public function snake(string $string): string
    {
        return Str::snake(Str::camel($string));
    }
}
