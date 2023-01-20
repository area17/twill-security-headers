<?php

namespace A17\TwillSecurityHeaders\Models;

use A17\Twill\Models\Model;
use A17\Twill\Models\Behaviors\HasRevisions;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property bool $published
 * @property string $csp_block
 * @property string $csp_report_only
 * @property string $unwanted_headers
 */
class TwillSecurityHeader extends Model
{
    use HasRevisions;

    protected $table = 'twill_sec_head';

    protected $fillable = [
        'published',
        'csp_enabled',
        'csp_block',
        'csp_report_only',
        'expect_ct',
        'expect_ct_enabled',
        'hsts',
        'hsts_enabled',
        'permissions_policy',
        'permissions_policy_enabled',
        'referrer_policy',
        'referrer_policy_enabled',
        'x_content_type_policy',
        'x_content_type_policy_enabled',
        'x_frame_policy',
        'x_frame_policy_enabled',
        'xss_protection_policy',
        'xss_protection_policy_enabled',
        'unwanted_headers',
    ];

    public function revisions(): HasMany
    {
        return $this->hasMany($this->getRevisionModel(), 'twill_sec_head_id')->orderBy('created_at', 'desc');
    }
}
