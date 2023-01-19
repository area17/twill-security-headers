<?php

namespace A17\TwillSecurityHeaders\Services\Headers;

use Illuminate\Http\Request;

class CSP extends Header
{
    public function setHeaders(Request $request, array $header): void
    {
        if (!$this->enabled($header)) {
            return;
        }

        if (filled($header = $this->securityHeaders->csp_block)) {
            $request->headers->set('Content-Security-Policy', $header);
        }

        if (filled($header = $this->securityHeaders->csp_report_only)) {
            $request->headers->set('Content-Security-Policy-Report-Only', $header);
        }
    }
}
