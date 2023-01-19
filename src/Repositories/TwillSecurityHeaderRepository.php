<?php

namespace A17\TwillSecurityHeaders\Repositories;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Repositories\ModuleRepository;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeader;
use A17\TwillSecurityHeaders\Support\Facades\TwillSecurityHeaders;

/**
 * @method \Illuminate\Database\Eloquent\Builder published()
 */
class TwillSecurityHeaderRepository extends ModuleRepository
{
    use HandleRevisions;

    public function __construct(TwillSecurityHeader $model)
    {
        $this->model = $model;
    }

    public function theOnlyOne(): TwillSecurityHeader
    {
        $record = TwillSecurityHeader::query()
            ->orderBy('id')
            ->first();

        return $record ?? $this->generate();
    }

    private function generate(): TwillSecurityHeader
    {
        /** @var TwillSecurityHeader $model */
        $model = app(self::class)->create([
            'hsts' => config('twill-security-headers.headers.hsts.default')['value'],
            'csp_block' => config('twill-security-headers.headers.csp.default')['block'],
            'csp_report_only' => config('twill-security-headers.headers.csp.default')['report-only'],
            'expect_ct' => config('twill-security-headers.headers.expect-ct.default')['value'],
            'xss_protection_policy' => config('twill-security-headers.headers.xss-protection-policy.default')['value'],
            'x_frame_policy' => config('twill-security-headers.headers.x-frame-policy.default')['value'],
            'x_content_type_policy' => config('twill-security-headers.headers.x-content-type-policy.default')['value'],
            'referrer_policy' => config('twill-security-headers.headers.referrer-policy.default')['value'],
            'permissions_policy' => config('twill-security-headers.headers.permissions-policy.default')['value'],
            'unwanted_headers' => implode(',', config('twill-security-headers.unwanted-headers')),
        ]);

        return $model;
    }

    public function getFormFields($object)
    {
        $fields = parent::getFormFields($object);

        $fields['headers'] = TwillSecurityHeaders::getAvailableHeaders();

        return $fields;
    }
}
