<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Page\StoreRequest;
use App\Http\Requests\Administrator\Page\TranslationRequest;
use App\Http\Requests\Administrator\Page\UpdateRequest;
use App\Http\Resources\Page;
use App\Models\Page as ModelsPage;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Page\PageRepository;
use App\Repositories\Page\PageTranslationRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class PageController extends AdminController
{
    private $view = 'administrator.modules.page.';

    private $route = 'admin.page.';

    private $module = 'module.page';

    private $page;

    private $pageTranslation;

    private $language;

    /**
     * PageController constructor.
     * @param PageRepository $page
     * @param PageTranslationRepository $pageTranslation
     * @param LanguageRepository $language
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(PageRepository $page,
                                PageTranslationRepository $pageTranslation,
                                LanguageRepository $language)
    {
        parent::__construct();
        $this->middleware('permission:page_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:page_create', ['only' => ['create', 'store', 'language', 'translation']]);
        $this->middleware('permission:page_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:page_destroy', ['only' => ['destroy']]);

        $this->page            = $page;
        $this->pageTranslation = $pageTranslation;
        $this->language        = $language;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function index()
    {
        if (Request::is('api*')) {
            $page = $this->page->getAll();
            return new Page($page);
        }

        return view($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function create()
    {
        return view($this->view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function store(StoreRequest $request)
    {
        $page            = null;
        $pageTranslation = null;

        DB::transaction(function () use ($request, &$page, &$pageTranslation) {
            $page = $this->page->create(
                [
                    'status'  => $request->status ?? 'off',
                    'user_id' => auth()->user()->id
                ]
            );

            $pageTranslation                    = $request->except(['_token', '_method', 'code', 'status']);
            $pageTranslation['meta_robots']     = implode(",", $request->meta_robots);
            $pageTranslation['meta_google_bot'] = implode(",", $request->meta_google_bot);
            $pageTranslation['page_id']         = $page->id;
            $pageTranslation['locale']          = config('app.locale');
            $pageTranslation                    = $this->pageTranslation->create($pageTranslation);

            ModelsPage::flushQueryCache(['pages']);

            LogActivityHelper::addToLog([
                'module'      => 'page',
                'action'      => 'create',
                'description' => $request->name
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
                'result'   => array('page' => $page, 'page_translation' => $pageTranslation)
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function show(string $uuid)
    {
        $data = $this->page->getByUuid($uuid);

        return response()->json(
            [
                'status' => 'success',
                'result' => $data
            ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function edit(string $uuid)
    {
        $data['page'] = $this->page->getByUuid($uuid);

        $transData = array(
            ['locale', app()->getLocale()],
            ['page_id', $data['page']->id]
        );

        $transUuid = $this->pageTranslation->getUuidByIdAndLocale($transData);

        if (is_null($transUuid)) {
            return redirect()->route($this->route . 'language', ['page' => $uuid])->with('error', message_module($this->module, 'crud.edit_trans_fail'));
        }

        return view($this->view . 'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update(UpdateRequest $request, string $uuid)
    {
        $page            = null;
        $pageTranslation = null;

        DB::transaction(function () use ($request, $uuid, &$page, &$pageTranslation) {
            $page = $this->page->update(
                [
                    'status'  => $request->status ?? 'off',
                    'user_id' => auth()->user()->id
                ], $uuid
            );

            $pageId = $this->page->getIdByUuid($uuid);

            $transData = array(
                ['locale', app()->getLocale()],
                ['page_id', $pageId]
            );

            $transUuid = $this->pageTranslation->getUuidByIdAndLocale($transData);

            $pageTranslation                    = $request->except(['_token', '_method', 'code', 'status']);
            $pageTranslation['meta_robots']     = implode(",", $request->meta_robots);
            $pageTranslation['meta_google_bot'] = implode(",", $request->meta_google_bot);
            $pageTranslation['page_id']         = $page->id;
            $pageTranslation                    = $this->pageTranslation->update($pageTranslation, $transUuid);

            ModelsPage::flushQueryCache(['pages']);

            LogActivityHelper::addToLog([
                'module'      => 'page',
                'action'      => 'edit',
                'description' => $request->name
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['page' => $uuid]),
                'result'   => array('page' => $page, 'pageTranslation' => $pageTranslation)
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function destroy(string $uuid)
    {
        $data = $this->page->getByUuid($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'page',
            'action'      => 'delete',
            'description' => $data->name,
        ]);

        $result = $this->page->remove($uuid);
        ModelsPage::flushQueryCache(['pages']);

        return response()->json(
            [
                'status'  => 'success',
                'message' => message_module($this->module, 'crud.destroy_success'),
                'result'  => $result
            ], 200);
    }

    /**
     * Process datatables ajax request.
     * @return mixed
     * @throws \Exception
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function dataTableIndex()
    {
        $page = $this->page->query()->whereNull('deleted_at');

        return Datatables::of($page)
            ->setRowClass(function ($page) {
                if (config('app.multi_language')) {
                    $translate = $this->translateRemaining($page->uuid);
                    return $translate["full"] ? 'text-default' : 'text-warning';
                } else {
                    return 'text-default';
                }
            })
            ->editColumn('name', function ($page) {
                $translate = $page->page_translation()->where('locale', config('app.locale'))->first();
                return $translate->name ?? '';
            })
            ->filterColumn('name', function(Builder $query ,$keyword) {
                $query->whereHas('page_translation', function (Builder $query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                });
            })
            ->editColumn('status', function ($page) {
                if ($page->status == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';

                }
                return $xhtml;
            })
            ->editColumn('content', function ($page) {
                return '<a href="' . route('admin.content.index', ['page' => $page->uuid]) . '">' . label('page.update') . '</a>';
            })
            ->addColumn('actions', function ($page) {
                return view('administrator.modules.page.actions', ['uuid' => $page->uuid, 'page' => $this]);
            })
            ->rawColumns(['actions', 'status', 'content'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Number of languages ​​remaining after the data has been created
     * @param string $uuid
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function translateRemaining(string $uuid): array
    {
        $id = $this->page->getIdByUuid($uuid);

        $totalLanguage      = $this->language->countRow();
        $languageTranslated = $this->pageTranslation->getTotalTranslated('page_id', $id);
        $languageRemaining  = "<span class='pl-1'>($languageTranslated/$totalLanguage)</span>";

        $totalLocale      = $this->language->getAllLocale()->toArray();
        $localeTranslated = $this->pageTranslation->getLocaleTranslated('page_id', $id)->toArray();
        $localeRemaining  = array_diff($totalLocale, $localeTranslated);

        return [
            'language' => $languageRemaining,
            'locale'   => $localeRemaining,
            'full'     => $languageTranslated == $totalLanguage
        ];
    }

    /**
     * Display language translation template
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function language(string $uuid)
    {
        $data['page'] = $this->page->getByUuid($uuid);

        $locale_current[]          = app()->getLocale();
        $data['languages_current'] = $this->language->getLanguageByLocale($locale_current);

        $translated_remaining        = $this->translateRemaining($uuid);
        $locale_remaining            = $translated_remaining['locale'];
        $data['languages_remaining'] = $this->language->getLanguageByLocale($locale_remaining);

        return view($this->view . 'translation', $data);
    }

    /**
     * Proceed with language translation
     * @param TranslationRequest $request
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function translation(TranslationRequest $request, string $uuid)
    {
        $page                    = $request->only('name', 'content', 'image', 'title_tag', 'meta_keywords', 'meta_description', 'locale');
        $page['meta_robots']     = implode(",", $request->meta_robots);
        $page['meta_google_bot'] = implode(",", $request->meta_google_bot);
        $page['page_id']         = $this->page->getIdByUuid($uuid);

        $result = $this->pageTranslation->create($page);

        $translated_remaining = $this->translateRemaining($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'page',
            'action'      => 'translation',
            'description' => $request->name_origin . " - " . $request->name,
        ]);

        if ($translated_remaining["full"]) {
            return response()->json(
                [
                    'status'   => 'success',
                    'message'  => message('language.update_full_language'),
                    'redirect' => route($this->route . 'index'),
                    'result'   => $result
                ], 201);
        } else {
            return response()->json(
                [
                    'status'   => 'success',
                    'message'  => message_module($this->module, 'crud.translate_success'),
                    'redirect' => route($this->route . 'language', ['news' => $uuid]),
                    'result'   => $result
                ], 201);
        }
    }
}
