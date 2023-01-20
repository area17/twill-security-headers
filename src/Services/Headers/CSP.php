<?php

namespace A17\TwillSecurityHeaders\Services\Headers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use A17\TwillSecurityHeaders\Services\Helpers;

class CSP extends Header
{
    public function setHeaders(Response|RedirectResponse|JsonResponse $response, array $header): void
    {
        if (!$this->enabled($header)) {
            return;
        }

        if (filled($header = $this->securityHeaders->csp_block)) {
            $response->headers->set('Content-Security-Policy', $this->addNounce($header));
        }

        if (filled($header = $this->securityHeaders->csp_report_only)) {
            $response->headers->set('Content-Security-Policy-Report-Only', $this->addNounce($header));
        }
    }

    public function addNounce($header): string
    {
        if (!$this->securityHeaders->csp_generate_nounce) {
            return $header;
        }

        // Remove nounce
        $pattern = "/ 'nonce-.*?'/";
        $replacement = "";
        $header = preg_replace($pattern, $replacement, $header);

        // Add nounce
        $pattern = '/(script-src \'self\'\ )/';
        $replacement = "$1'nonce-".Helpers::nounce()."' ";
        $header = preg_replace($pattern, $replacement, $header);

        return $header;
    }
}
