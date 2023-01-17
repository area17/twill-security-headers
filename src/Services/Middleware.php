<?php

namespace A17\TwillSecurityHeaders\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;

trait Middleware
{
    public function middleware(Response|RedirectResponse $response, string|array $types = '*'): Response|RedirectResponse
    {
        if ($this->config('enabled_inside_twill') || !$this->runningOnTwill()) {
            $this->getHeaders($types)->each(fn($header) => $this->setHeaders($response, $header));
        }

        return $response;
    }

    protected function getHeaders(string|array $type): Collection
    {
        $types = collect($this->config('headers'));

        if ($type !== '*') {
            $types = $types->only((array) $type);
        }

        return $types;
    }

    public function setHeaders(Response|RedirectResponse $response, array $header): void
    {
        app($header['service'])->setHeaders($response, $header);
    }
}
