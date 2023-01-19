<?php

namespace A17\TwillSecurityHeaders\Services;

use Illuminate\Support\Arr;
use A17\TwillSecurityHeaders\Repositories\TwillSecurityHeaderRepository;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeader as TwillSecurityHeadersModel;

trait Config
{
    public function config(string|null $key = null, mixed $default = null): mixed
    {
        $this->config ??= filled($this->config) ? $this->config : (array) config('twill-security-headers');

        if (blank($key)) {
            return $this->config;
        }

        return Arr::get((array) $this->config, $key) ?? $default;
    }
}
