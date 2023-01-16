<?php

namespace A17\TwillSecurityHeaders\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;

trait Middleware
{
    public function middleware(Response $response, string|array $types = '*'): Response
    {
        $this->getHeaders($types)->each(fn($header) => $this->setHeaders($response, $header));

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

    public function setHeaders(Response $response, array $header): void
    {
        dd($header);
    }
}
