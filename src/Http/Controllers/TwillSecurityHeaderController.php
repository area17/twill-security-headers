<?php

namespace A17\TwillSecurityHeaders\Http\Controllers;

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
        return redirect()->route('admin.twillSecurityHeaders.show', ['twillSecurityHeader' => $repository->theOnlyOne()->id]);
    }

    /**
     * @param int|null $parentModuleId
     * @return array|\Illuminate\View\View|RedirectResponse
     */
    public function index($parentModuleId = null)
    {
        return redirect()->route('admin.twillSecurityHeaders.redirectToEdit');
    }

    /**
     * @param int $id
     * @param int|null $submoduleId
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, $submoduleId = null)
    {
        $repository = new TwillSecurityHeaderRepository(new TwillSecurityHeader());

        return parent::edit($repository->theOnlyOne()->id, $submoduleId);
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
        return 'twill-google-recaptcha::admin';
    }
}
