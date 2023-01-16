<?php

namespace A17\TwillSecurityHeaders\Services;

use Illuminate\Support\Arr;
use A17\TwillSecurityHeaders\Repositories\TwillSecurityHeadersRepository;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeaders as TwillSecurityHeadersModel;

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

    public function get(string $configKey, string $databaseColumn, bool $force = false): string|null
    {
        if (!$force && (!$this->isConfigured() || !$this->protected())) {
            return null;
        }

        return $this->hasDotEnv() ? $this->config($configKey) : $this->readFromDatabase($databaseColumn);
    }

    protected function readFromDatabase(string $key): string|bool|null
    {
        if (blank($this->current)) {
            $domains = app(TwillSecurityHeadersRepository::class)->orderBy('domain');

            if ($this->hasDotEnv()) {
                $domains->where('domain', '*');
            } else {
                $domains->where('domain', $this->getDomain());
            }

            $domains = $domains->get();

            $domains = $domains->filter(
                fn($domain) => filled($domain->getAttributes()['protected']) &&
                    filled($domain->getAttributes()['unprotected']),
            );

            if ($domains->isEmpty()) {
                return null;
            }

            /** @var TwillSecurityHeadersModel|null $domain */
            $domain = $domains->first();

            if ($domain !== null && $domain->domain === '*') {
                $this->current = $domain;
            } else {
                /** @var TwillSecurityHeadersModel|null $domain */
                $domain = $domains->firstWhere('domain', $this->getDomain());

                $this->current = $domain;
            }
        }

        if ($this->current === null) {
            return null;
        }

        return $this->decrypt($this->current->getAttributes()[$key]);
    }

    public function hasDotEnv(): bool
    {
        return filled($this->config('contents.protected') ?? null) && filled($this->config('contents.unprotected') ?? null);
    }

    protected function isConfigured(): bool
    {
        return $this->isConfigured ??
            $this->hasDotEnv() || (filled($this->protectedContents(true)) && filled($this->unprotectedContents(true)));
    }

    protected function setConfigured(): void
    {
        $this->isConfigured = $this->isConfigured();
    }

    public function setCurrent(TwillSecurityHeadersModel $current): static
    {
        $this->current = $current;

        return $this;
    }

    public function getCurrent()
    {
        if (blank($this->current)) {
            $this->readFromDatabase('domain');
        }

        return $this->current;
    }
}
