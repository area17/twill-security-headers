<?php

return [
    'headers' => [
        'csp' => [
            'type' => 'csp',
            'header' => 'Content-Security-Policy',
            'default' => "default-src 'self'; img-src https://<domain>; child-src 'none';",
            'middleware' => \A17\TwillSecurityHeaders\Http\Middleware\CSP::class,
        ],

        'expect-ct' => [
            'type' => 'expect-ct',
            'header' => 'Expect-CT',
            'default' => 'enforce, max-age=30',
            'middleware' => \A17\TwillSecurityHeaders\Http\Middleware\ExpectCT::class,
        ],

        'hsts' => [
            'type' => 'hsts',
            'header' => 'Strict-Transport-Security',
            'default' => 'max-age=31536000; includeSubDomains',
            'middleware' => \A17\TwillSecurityHeaders\Http\Middleware\HSTS::class,
        ],

        'permissions-policy' => [
            'type' => 'permissions-policy',
            'header' => 'Permissions-Policy',
            'default' => 'autoplay=(self), camera=(), encrypted-media=(self), fullscreen=(), geolocation=(self), gyroscope=(self), magnetometer=(), microphone=(), midi=(), payment=(), sync-xhr=(self), usb=()',
            'middleware' => \A17\TwillSecurityHeaders\Http\Middleware\PermissionsPolicy::class,
        ],

        'referrer-policy' => [
            'type' => 'referrer-policy',
            'header' => 'Referrer-Policy',
            'default' => 'no-referrer-when-downgrade',
            'middleware' => \A17\TwillSecurityHeaders\Http\Middleware\ReferrerPolicy::class,
        ],

        'x-content-type' => [
            'type' => 'x-content-type',
            'header' => 'X-Content-Type-Options',
            'default' => 'nosniff',
            'middleware' => \A17\TwillSecurityHeaders\Http\Middleware\XContentType::class,
        ],

        'x-frame' => [
            'type' => 'x-frame',
            'header' => 'X-Frame-Options',
            'default' => 'SAMEORIGIN',
            'middleware' => \A17\TwillSecurityHeaders\Http\Middleware\XFrame::class,
        ],

        'xss-protection' => [
            'type' => 'xss-protection',
            'header' => 'X-XSS-Protection',
            'default' => '1; mode=block',
            'middleware' => \A17\TwillSecurityHeaders\Http\Middleware\XSSProtection::class,
        ],
    ]
];
