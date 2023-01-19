<?php

namespace A17\TwillSecurityHeaders\Services\Headers;

use Illuminate\Http\Request;

class RemoveUnwanted extends Header
{
    public function remove(Request $request): void
    {
        if (!$this->securityHeaders->published) {
            return;
        }

        collect(explode(',', $this->securityHeaders->unwanted_headers))
            ->map(fn($header) => trim($header))
            ->filter()
            ->each(fn($header) => $request->headers->remove($header));
    }
}
