<?php

namespace A17\TwillSecurityHeaders\Models\Behaviors;

use Throwable;
use Illuminate\Support\Facades\Crypt;

trait Encrypt
{
    public function encrypt(string|null $value): string|null
    {
        if (blank($value)) {
            return null;
        }

        $encrypted = 'ENCRYPTION ERROR';

        try {
            $encrypted = Crypt::encryptString($value);
        } catch (\Throwable) {
        }

        return $encrypted;
    }

    public function decrypt(string|null $value): string|null
    {
        if (blank($value)) {
            return null;
        }

        $decrypted = '';

        try {
            $decrypted = Crypt::decryptString($value);
        } catch (\Throwable) {
            $decrypted = $value;
        }

        return $decrypted;
    }
}
