<?php

namespace A17\TwillSecurityHeaders\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeaders;

/**
 * @method \Illuminate\Database\Eloquent\Builder published()
 */
class TwillSecurityHeadersRepository extends ModuleRepository
{
    use HandleRevisions;

    public function __construct(TwillSecurityHeaders $model)
    {
        $this->model = $model;
    }
}
