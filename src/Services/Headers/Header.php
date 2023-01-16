<?php

namespace A17\TwillSecurityHeaders\Services\Headers;

class Header
{
    public function setHeaders($request, $header): void
    {
        $request->headers->set($header['header'], $this->compileHeader($header));
    }

    private function compileHeader($header)
    {
        return $header['default'];
    }
}
