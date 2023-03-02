<?php

namespace A17\TwillSecurityHeaders\Services;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use A17\TwillSecurityHeaders\Services\Headers\RemoveUnwanted;

trait Middleware
{
    public function middleware(
        Response|RedirectResponse|JsonResponse $response,
        string|array $types = '*',
    ): Response|RedirectResponse|JsonResponse|BinaryFileResponse {
        if ($this->config('enabled_inside_twill') || !$this->runningOnTwill()) {
            $this->getHeaders($types)->each(fn($header) => $this->setHeaders($response, $header));
        }

        $this->removeUnwantedHeaders($response);

        return $response;
    }

    protected function getHeaders(string|array $type): Collection
    {
        $headers = \A17\TwillSecurityHeaders\Support\Facades\TwillSecurityHeaders::getAvailableHeaders();

        if ($type !== '*') {
            $headers = $headers->only((array) $type);
        }

        return $headers;
    }

    public function setHeaders(Response|RedirectResponse|JsonResponse $response, array $header): void
    {
        app($header['service'])->setHeaders($response, $header);
    }

    public function removeUnwantedHeaders(
        \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse $response,
    ): void {
        app(RemoveUnwanted::class)->remove($response);
    }
}
