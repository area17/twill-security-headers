<?php

namespace A17\TwillSecurityHeaders\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeaders;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeader;

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
            ->published()
            ->orderBy('id')
            ->first();

        return $record ?? $this->generate();
    }

    private function generate(): TwillSecurityHeader
    {
        return app(self::class)->create([
            'site_key' => null,

            'private_key' => null,

            'published' => true,
        ]);
    }
}
