<?php

namespace A17\TwillSecurityHeaders\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use A17\Twill\Http\Controllers\Admin\ModuleController;
use A17\TwillSecurityHeaders\Models\TwillSecurityHeaders;
use A17\TwillSecurityHeaders\Repositories\TwillSecurityHeadersRepository;
use A17\TwillSecurityHeaders\Support\Facades\TwillSecurityHeaders as TwillSecurityHeadersFacade;

class TwillSecurityHeadersController extends ModuleController
{
    protected $moduleName = 'twillSecurityHeaders';

    protected $titleColumnKey = 'domain_string';

    protected $titleFormKey = 'domain';

    protected $defaultOrders = ['domain' => 'asc'];

    protected $indexColumns = [
        'domain_string' => [
            'title' => 'Domain',
            'field' => 'domain_string',
        ],

        'status' => [
            'title' => 'Status',
            'field' => 'status',
        ],

        'from_dot_env' => [
            'title' => 'From .env',
            'field' => 'from_dot_env',
        ],
    ];

    /**
     * @param int|null $parentModuleId
     * @return array|\Illuminate\View\View|RedirectResponse
     */
    public function index($parentModuleId = null)
    {
        $this->generateDomains();

        $this->setIndexOptions();

        return parent::index($parentModuleId = null);
    }

    protected function getViewPrefix(): string|null
    {
        return 'twill-security-headers::admin';
    }

    public function generateDomains(): void
    {
        if (DB::table('twill_security_headers')->count() !== 0) {
            return;
        }

        $appDomain = TwillSecurityHeadersFacade::getDomain(config('app.url'));

        $currentDomain = TwillSecurityHeadersFacade::getDomain(URL::current());

        /** @phpstan-ignore-next-line  */
        app(TwillSecurityHeadersRepository::class)->create([
            'domain' => '*',
            'published' => false,
            'protected' => TwillSecurityHeadersFacade::config('contents.protected'),
            'unprotected' => TwillSecurityHeadersFacade::config('contents.unprotected'),
        ]);

        if (filled($currentDomain)) {
            /** @phpstan-ignore-next-line  */
            app(TwillSecurityHeadersRepository::class)->create([
                'domain' => $currentDomain,
                'published' => true,
                'protected' => TwillSecurityHeadersFacade::config('contents.protected'),
                'unprotected' => TwillSecurityHeadersFacade::config('contents.unprotected'),
            ]);
        }

        if (filled($appDomain) && $appDomain !== $currentDomain) {
            /** @phpstan-ignore-next-line  */
            app(TwillSecurityHeadersRepository::class)->create([
                'domain' => $appDomain,
                'published' => true,
                'protected' => TwillSecurityHeadersFacade::config('contents.protected'),
                'unprotected' => TwillSecurityHeadersFacade::config('contents.unprotected'),
            ]);
        }
    }

    public function setIndexOptions(): void
    {
        $this->indexOptions = ['create' => !TwillSecurityHeadersFacade::allDomainsPublished()];
    }

    /**
     * @param array $scopes
     * @param bool $forcePagination
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getIndexItems($scopes = [], $forcePagination = false)
    {
        if (TwillSecurityHeadersFacade::allDomainsPublished()) {
            $scopes['domain'] = '*';
        } else {
            $all = TwillSecurityHeaders::where('domain', '*')->first();

            $scopes['exceptIds'] = [$all->id];
        }

        return parent::getIndexItems($scopes, $forcePagination);
    }
}
