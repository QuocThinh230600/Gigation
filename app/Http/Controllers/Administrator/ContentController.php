<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Content\StoreRequest;
use App\Http\Requests\Administrator\Content\TranslationRequest;
use App\Http\Requests\Administrator\Content\UpdateRequest;
use App\Http\Resources\Content;
use App\Models\Content as ModelsContent;
use App\Repositories\Content\ContentRepository;
use App\Repositories\Content\ContentTranslationRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Page\PageRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ContentController extends AdminController
{
    private $view = 'administrator.modules.content.';

    private $route = 'admin.content.';

    private $module = 'module.content';

    private $content;

    private $page;

    private $contentTranslation;

    private $language;

    /**
     * ContentController constructor.
     * @param ContentRepository $content
     * @param PageRepository $page
     * @param ContentTranslationRepository $contentTranslation
     * @param LanguageRepository $language
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ContentRepository $content,
                                PageRepository $page,
                                ContentTranslationRepository $contentTranslation,
                                LanguageRepository $language)
    {
        parent::__construct();
        $this->middleware('permission:content_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:content_create', ['only' => ['create', 'store', 'language', 'translation']]);
        $this->middleware('permission:content_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:content_destroy', ['only' => ['destroy']]);

        $this->content            = $content;
        $this->page               = $page;
        $this->contentTranslation = $contentTranslation;
        $this->language           = $language;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function index($pageUuid)
    {
        $data['page'] = $this->page->getByUuid($pageUuid);

        if (Request::is('api*')) {
            $content = $this->content->getContentWithPage($data['page']->id);
            return new Content($content);
        }

        return view($this->view . 'index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $page
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function create(string $page)
    {
        $data['page'] = $this->page->getByUuid($page);

        return view($this->view . 'create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param string $page
     * @return mixed
     * @throws \Throwable
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function store(StoreRequest $request, string $page)
    {
        $content            = null;
        $contentTranslation = null;

        DB::transaction(function () use ($request, $page, &$content, &$contentTranslation) {
            $content = $this->content->create(
                [
                    'page_id' => $this->page->getIdByUuid($page),
                    'status'  => $request->status ?? 'off',
                    'user_id' => auth()->user()->id
                ]
            );

            $contentTranslation               = $request->only(['content', 'image', 'locale']);
            $contentTranslation['content_id'] = $content->id;
            $contentTranslation['locale']     = config('app.locale');
            $contentTranslation               = $this->contentTranslation->create($contentTranslation);

            $page = $this->page->getByUuid($page);

            ModelsContent::flushQueryCache(['contents']);

            LogActivityHelper::addToLog([
                'module'      => 'content',
                'action'      => 'create',
                'description' => "Content: " . strip_tags($contentTranslation->content) . " - Page: " . $page->name,
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create', ['page' => $page]),
                'result'   => array('content' => $content, 'content_translation' => $contentTranslation)
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param string $content
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function show(string $content)
    {
        $result = $this->content->getByUuid($content);

        return response()->json(
            [
                'status' => 'success',
                'result' => $result
            ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $page
     * @param string $content
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function edit(string $page, string $content)
    {
        $data['content'] = $this->content->getByUuid($content);
        $data['page']    = $this->page->getByUuid($page);

        $transData = array(
            ['locale', app()->getLocale()],
            ['content_id', $data['content']->id]
        );

        $transUuid = $this->contentTranslation->getUuidByIdAndLocale($transData);

        if (is_null($transUuid)) {
            return redirect()->route($this->route . 'language', ['page' => $page, 'content' => $content])->with('error', message_module($this->module, 'crud.edit_trans_fail'));
        }

        return view($this->view . 'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param string $page
     * @param string $content
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update(UpdateRequest $request, string $page, string $content)
    {
        $content_update     = null;
        $contentTranslation = null;

        DB::transaction(function () use ($request, $page, $content, &$content_update, &$contentTranslation) {
            $content_update = $this->content->update(
                [
                    'page_id' => $this->page->getIdByUuid($page),
                    'status'  => $request->status ?? 'off',
                    'user_id' => auth()->user()->id
                ], $content
            );

            $contentId = $this->content->getIdByUuid($content);
            ModelsContent::flushQueryCache(['contents']);
            $transData = array(
                ['locale', app()->getLocale()],
                ['content_id', $contentId]
            );

            $transUuid = $this->contentTranslation->getUuidByIdAndLocale($transData);

            $contentTranslation               = $request->only(['content', 'image', 'locale']);
            $contentTranslation['content_id'] = $contentId;
            $contentTranslation               = $this->contentTranslation->update($contentTranslation, $transUuid);

            $page = $this->page->getByUuid($page);

            LogActivityHelper::addToLog([
                'module'      => 'content',
                'action'      => 'edit',
                'description' => "Content: " . $contentTranslation->content . " - Page: " . $page->name,
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['page' => $page, 'content' => $content]),
                'result'   => array('content' => $content_update, 'content_translation' => $contentTranslation)
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $page
     * @param string $content
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function destroy(string $page, string $content)
    {
        $data = $this->content->getByUuid($content);

        LogActivityHelper::addToLog([
            'module'      => 'content',
            'action'      => 'delete',
            'description' => "Content: " . $data->content,
        ]);

        $result = $this->content->remove($content);
        ModelsContent::flushQueryCache(['contents']);

        return response()->json(
            [
                'status'  => 'success',
                'message' => message_module($this->module, 'crud.destroy_success'),
                'result'  => $result
            ], 200);
    }

    /**
     * Process datatables ajax request.
     * @param string $pageUuid
     * @return mixed
     * @throws \Exception
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function dataTableIndex(string $pageUuid)
    {
        $pageId = $this->page->getIdByUuid($pageUuid);

        $content = $this->content->query()
            ->where('page_id', $pageId)
            ->whereNull('deleted_at');

        return Datatables::of($content)
            ->setRowClass(function ($content) {
                if (config('app.multi_language')) {
                    $translate = $this->translateRemaining($content->uuid);
                    return $translate["full"] ? 'text-default' : 'text-warning';
                } else {
                    return 'text-default';
                }
            })
            ->editColumn('content', function ($content) {
                $translate = $content->content_translation()->where('locale', config('app.locale'))->first();
                return Str::limit(strip_tags($translate->content ?? ''), 50);
            })
            ->filterColumn('content', function(Builder $query ,$keyword) {
                $query->whereHas('content_translation', function (Builder $query) use ($keyword) {
                    $query->where('content', 'like', "%{$keyword}%");
                });
            })
            ->editColumn('status', function ($content) {
                if ($content->status == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';
                }
                return $xhtml;
            })
            ->addColumn('actions', function ($content) {
                return view('administrator.modules.content.actions', [
                    'page'    => DB::table('pages')->where('id', $content->page_id)->first()->uuid,
                    'uuid'    => $content->uuid,
                    'content' => $this
                ]);
            })
            ->rawColumns(['content', 'status', 'actions'])
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
        $id = $this->content->getIdByUuid($uuid);

        $totalLanguage      = $this->language->countRow();
        $languageTranslated = $this->contentTranslation->getTotalTranslated('content_id', $id);
        $languageRemaining  = "<span class='pl-1'>($languageTranslated/$totalLanguage)</span>";

        $totalLocale      = $this->language->getAllLocale()->toArray();
        $localeTranslated = $this->contentTranslation->getLocaleTranslated('content_id', $id)->toArray();
        $localeRemaining  = array_diff($totalLocale, $localeTranslated);

        return [
            'language' => $languageRemaining,
            'locale'   => $localeRemaining,
            'full'     => $languageTranslated == $totalLanguage
        ];
    }

    /**
     * Display language translation template
     * @param string $page
     * @param string $content
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function language(string $page, string $content)
    {
        $data['page']    = $this->page->getByUuid($page);
        $data['content'] = $this->content->getByUuid($content);

        $locale_current[]          = app()->getLocale();
        $data['languages_current'] = $this->language->getLanguageByLocale($locale_current);

        $translated_remaining        = $this->translateRemaining($content);
        $locale_remaining            = $translated_remaining['locale'];
        $data['languages_remaining'] = $this->language->getLanguageByLocale($locale_remaining);

        return view($this->view . 'translation', $data);
    }

    /**
     * Proceed with language translation
     * @param TranslationRequest $request
     * @param string $page
     * @param string $content
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function translation(TranslationRequest $request, string $page, string $content)
    {
        $pageContent               = $request->only('content', 'image', 'locale');
        $pageContent['content_id'] = $this->content->getIdByUuid($content);

        $result = $this->contentTranslation->create($pageContent);

        $translated_remaining = $this->translateRemaining($content);

        LogActivityHelper::addToLog([
            'module'      => 'content',
            'action'      => 'translation',
            'description' => $request->content_origin,
        ]);

        if ($translated_remaining["full"]) {
            return response()->json(
                [
                    'status'   => 'success',
                    'message'  => message('language.update_full_language'),
                    'redirect' => route($this->route . 'index', ['page' => $page]),
                    'result'   => $result
                ], 201);
        } else {
            return response()->json(
                [
                    'status'   => 'success',
                    'message'  => message_module($this->module, 'crud.translate_success'),
                    'redirect' => route($this->route . 'language', ['page' => $page, 'content' => $content]),
                    'result'   => $result
                ], 201);
        }
    }
}
