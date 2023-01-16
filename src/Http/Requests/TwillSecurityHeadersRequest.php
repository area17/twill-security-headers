<?php

namespace A17\TwillSecurityHeaders\Http\Requests;

use A17\Twill\Http\Requests\Admin\Request;

class TwillSecurityHeadersRequest extends Request
{
    public function rulesForCreate(): array
    {
        return [];
    }

    public function rulesForUpdate(): array
    {
        return [];
    }
}
