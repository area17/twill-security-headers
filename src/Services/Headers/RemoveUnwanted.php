<?php

namespace A17\TwillSecurityHeaders\Services\Headers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RemoveUnwanted extends Header
{
    public function remove(Response|RedirectResponse|JsonResponse|BinaryFileResponse $response): void
    {
        if (!$this->securityHeaders->published) {
            return;
        }

        collect(explode(',', $this->securityHeaders->unwanted_headers))
            ->map(fn($header) => trim($header))
            ->filter()
            ->each(fn($header) => $response->headers->remove($header));
    }
}
