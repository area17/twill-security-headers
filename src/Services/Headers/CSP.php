<?php

namespace A17\TwillSecurityHeaders\Services\Headers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CSP extends Header
{
    public function setHeaders(Response|RedirectResponse|JsonResponse $response, array $header): void
    {
        if (!$this->enabled($header)) {
            return;
        }

        if (filled($header = $this->securityHeaders->csp_block)) {
            $response->headers->set('Content-Security-Policy', $header);
        }

        if (filled($header = $this->securityHeaders->csp_report_only)) {
            $response->headers->set('Content-Security-Policy-Report-Only', $header);
        }
    }
}
