<?php

namespace A17\TwillSecurityHeaders\Support;

use A17\SecurityHeaders\SecurityHeaders;
use A17\TwillSecurityHeaders\Services\Config;
use A17\TwillSecurityHeaders\Services\Middleware;
use A17\TwillSecurityHeaders\Models\Behaviors\Encrypt;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeaders as TwillSecurityHeadersModel;
use Illuminate\Http\Response;

class TwillSecurityHeaders
{
    use Encrypt, Config, Middleware;

    public const DEFAULT_ERROR_MESSAGE = 'Invisible captcha failed.';

    protected array|null $config = null;

    protected bool|null $isConfigured = null;

    protected bool|null $protected = null;

    protected TwillSecurityHeadersModel|null $current = null;

    public function published(bool $force = false): string|null
    {
        return $this->get('protected', 'published', $force);
    }

    protected function setProtected(): void
    {
        $this->protected = $this->protected();
    }

    public function getDomain(string|null $url = null): string|null
    {
        $url = parse_url($url ?? request()->url());

        return $url['host'] ?? null;
    }

    public function securityHeaders(): string
    {
        return $this->getCurrent()->published ? $this->getCurrent()->protected : $this->getCurrent()->unprotected;
    }
}
