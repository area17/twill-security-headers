<?php

return [
    'middleware' => [
        'automatic' => false,

        'enabled_inside_twill' => false,

        'groups' => [
            [
                'group' => 'web',
                'type' => 'prepend',
                'classes' => [
                    \A17\TwillSecurityHeaders\Http\Middleware\All::class
                ],
            ],

            [
                'group' => 'api',
                'type' => 'prepend',
                'classes' => [
                    \A17\TwillSecurityHeaders\Http\Middleware\All::class
                ],
            ]
        ],
    ],

    'headers' => [
        'csp' => [
            'type' => 'csp',
            'header' => 'Content-Security-Policy',
            'default' => "default-src 'self'; img-src https://<domain>; child-src 'none';",
            'service' => \A17\TwillSecurityHeaders\Services\Headers\CSP::class,
        ],

        'expect-ct' => [
            'type' => 'expect-ct',
            'header' => 'Expect-CT',
            'default' => 'enforce, max-age=30',
            'service' => \A17\TwillSecurityHeaders\Services\Headers\ExpectCT::class,
        ],

        'hsts' => [
            'type' => 'hsts',
            'header' => 'Strict-Transport-Security',
            'default' => 'max-age=31536000; includeSubDomains',
            'service' => \A17\TwillSecurityHeaders\Services\Headers\HSTS::class,
        ],

        'permissions-policy' => [
            'type' => 'permissions-policy',
            'header' => 'Permissions-Policy',
            'default' => 'autoplay=(self), camera=(), encrypted-media=(self), fullscreen=(), geolocation=(self), gyroscope=(self), magnetometer=(), microphone=(), midi=(), payment=(), sync-xhr=(self), usb=()',
            'service' => \A17\TwillSecurityHeaders\Services\Headers\PermissionsPolicy::class,
        ],

        'referrer-policy' => [
            'type' => 'referrer-policy',
            'header' => 'Referrer-Policy',
            'default' => 'no-referrer-when-downgrade',
            'service' => \A17\TwillSecurityHeaders\Services\Headers\ReferrerPolicy::class,
        ],

        'x-content-type' => [
            'type' => 'x-content-type',
            'header' => 'X-Content-Type-Options',
            'default' => 'nosniff',
            'service' => \A17\TwillSecurityHeaders\Services\Headers\XContentType::class,
        ],

        'x-frame' => [
            'type' => 'x-frame',
            'header' => 'X-Frame-Options',
            'default' => 'SAMEORIGIN',
            'service' => \A17\TwillSecurityHeaders\Services\Headers\XFrame::class,
        ],

        'xss-protection' => [
            'type' => 'xss-protection',
            'header' => 'X-XSS-Protection',
            'default' => '1; mode=block',
            'service' => \A17\TwillSecurityHeaders\Services\Headers\XSSProtection::class,
        ],
    ],

    'twill_route_name_prefix' => 'admin',
];
