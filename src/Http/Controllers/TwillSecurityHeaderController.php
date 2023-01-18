<?php

namespace A17\TwillSecurityHeaders\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use A17\Twill\Http\Controllers\Admin\ModuleController;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeader;
use A17\TwillSecurityHeaders\Repositories\TwillSecurityHeaderRepository;
use Illuminate\Support\Str;

class TwillSecurityHeaderController extends ModuleController
{
    protected $moduleName = 'twillSecurityHeaders';

    protected $titleColumnKey = 'site_key';

    protected $indexOptions = ['edit' => false];

    public function redirectToEdit(TwillSecurityHeaderRepository $repository): RedirectResponse
    {
        return redirect()->route('admin.twillSecurityHeaders.show', ['twillSecurityHeader' => $repository->theOnlyOne()->id]);
    }

    public function index(int|null $parentModuleId = null): mixed
    {
        return redirect()->route('admin.twillSecurityHeaders.redirectToEdit');
    }

    public function edit(\A17\Twill\Models\Contracts\TwillModelContract|int $id): mixed
    {
        $repository = new TwillSecurityHeaderRepository(new TwillSecurityHeader());

        return parent::edit($repository->theOnlyOne()->id, $id);
    }

    protected function formData($request): array
    {
        return [
            'editableTitle' => false,
            'customTitle' => ' ',
        ];
    }

    protected function getViewPrefix(): string|null
    {
        return Str::kebab($this->moduleName).'::admin';
    }
}
