<?php

namespace A17\TwillSecurityHeaders\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use A17\Twill\Http\Controllers\Admin\ModuleController;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeader;
use A17\TwillSecurityHeaders\Repositories\TwillSecurityHeaderRepository;

class TwillSecurityHeaderController extends ModuleController
{
    protected $moduleName = 'twillSecurityHeaders';

    protected $titleColumnKey = 'site_key';

    protected $indexOptions = ['edit' => false];

    public function redirectToEdit(TwillSecurityHeaderRepository $repository): RedirectResponse
    {
        return redirect()->route($this->namePrefix() . 'twillSecurityHeaders.show', [
            'twillSecurityHeader' => $repository->theOnlyOne()->id,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\View|JsonResponse|RedirectResponse
     */
    public function index($parentModuleId = null)
    {
        return redirect()->route($this->namePrefix() . 'twillSecurityHeaders.redirectToEdit');
    }

    public function edit($id, $submoduleId = null)
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
        return Str::kebab($this->moduleName) . '::admin';
    }

    private function namePrefix(): string|null
    {
        return config('twill.admin_route_name_prefix');
    }
}
