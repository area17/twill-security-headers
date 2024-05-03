<?php

namespace A17\TwillSecurityHeaders\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\Route;
use A17\SecurityHeaders\SecurityHeaders;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeader as TwillSecurityHeadersModel;

class TwillSecurityHeaders
{
    use Config;
    use Middleware;

    protected array|null $config = null;

    protected bool|null $isConfigured = null;

    protected bool|null $protected = null;

    protected TwillSecurityHeadersModel|null $current = null;

    protected string|null $nonce = null;

    public function runningOnTwill(): bool
    {
        $prefix = config('twill.admin_route_name_prefix') ?? 'admin.';

        return Str::startsWith((string) Route::currentRouteName(), $prefix);
    }

    public function getAvailableHeaders(): Collection
    {
        return (new Collection($this->config('headers')))->reject(fn($header) => !$header['available']);
    }

    public function nonce(): string
    {
        return $this->nonce;
    }

    public function configureNonce(): void
    {
        $this->nonce ??= Str::random(32);

        $this->configureVite($this->nonce);
    }

    public function configureVite(string $nonce): bool
    {
        $onVite = class_exists(\Illuminate\Support\Facades\Vite::class);

        if ($onVite) {
            \Illuminate\Support\Facades\Vite::useCspNonce($nonce);

            \Illuminate\Support\Facades\Vite::useScriptTagAttributes([
                'nonce' => $nonce,
            ]);

            \Illuminate\Support\Facades\Vite::useStyleTagAttributes([
                'nonce' => $nonce,
            ]);
        }

        return $onVite;
    }
}
