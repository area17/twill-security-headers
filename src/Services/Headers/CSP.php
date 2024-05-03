<?php

namespace A17\TwillSecurityHeaders\Services\Headers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use A17\TwillSecurityHeaders\Services\Helpers;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CSP extends Header
{
    public function setHeaders(Response|RedirectResponse|JsonResponse|BinaryFileResponse $response, array $header): void
    {
        if (!$this->enabled($header)) {
            return;
        }

        if (filled($header = $this->sanitizeHeaderString($this->securityHeaders->csp_block))) {
            $response->headers->set('Content-Security-Policy', $this->addNonce($header));
        }

        if (filled($header = $this->sanitizeHeaderString($this->securityHeaders->csp_report_only))) {
            $response->headers->set('Content-Security-Policy-Report-Only', $this->addNonce($header));
        }
    }

    public function addNonce(string $header): string
    {
        if (!$this->securityHeaders->csp_generate_nonce) {
            return $header;
        }

        // Remove old nonce
        $pattern = "/ 'nonce-.*?'/";
        $replacement = '';
        $header = preg_replace($pattern, $replacement, $header) ?? '';

        // Add nonce
        $search = ['script-src', 'style-src'];

        foreach ($search as $value) {
            $pattern = "/($value\s)/";

            $replacement = "$1'nonce-" . Helpers::nonce() . "' ";

            $header = preg_replace($pattern, $replacement, $header) ?? '';
        }

        return $header;
    }
}
