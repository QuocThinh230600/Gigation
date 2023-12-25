<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\News\StoreRequest;
use App\Http\Requests\Administrator\News\TranslationRequest;
use App\Http\Requests\Administrator\News\UpdateRequest;
use App\Http\Resources\News;
use App\Models\News as ModelsNews;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\News\NewsRepository;
use App\Repositories\News\NewsTranslationRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\Builder;

class NewsController extends AdminController
{
    private $view = 'administrator.modules.news.';

    private $route = 'admin.news.';

    private $module = 'module.news';

    private $news;

    private $category;

    private $newsTranslation;

    private $language;

    /**
     * NewsController constructor.
     * @param LanguageRepository $language
     * @param NewsRepository $news
     * @param CategoryRepository $category
     * @param NewsTranslationRepository $newsTranslation
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(LanguageRepository $language,
                                NewsRepository $news,
                                CategoryRepository $category,
                                NewsTranslationRepository $newsTranslation)
    {
        parent::__construct();
        $this->middleware('permission:news_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:news_create', ['only' => ['create', 'store', 'language', 'translation']]);
        $this->middleware('permission:news_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:news_destroy', ['only' => ['destroy']]);

        $this->language        = $language;
        $this->news            = $news;
        $this->category        = $category;
        $this->newsTranslation = $newsTranslation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function index()
    {
        $data['category'] = $this->category->getAllCategoryRecursive();

        if (Request::is('api*')) {
            $news = $this->news->getAll();
            return new News($news);
        }

        return view($this->view . 'index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function create()
    {
        $data['category_name'] = 'category';
        $data['categories']    = $this->category->getAllCategoryRecursive();
        $data['position']      = $this->news->getNewPosition();


        return view($this->view . 'create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return mixed
     * @throws \Throwable
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function store(StoreRequest $request)
    {
        $news            = null;
        $newsTranslation = null;

        DB::transaction(function () use ($request, &$news, &$newsTranslation) {
            $news             = $request->only('date_start', 'time_start', 'position', 'open_link', 'status', 'featured', 'template', 'viewed');
            $news['access']   = is_null($request->access) ? null : implode(",", $request->access);
            $news['featured'] = is_null($request->featured) ? null : implode(",", $request->featured);
            $news['user_id']  = auth()->user()->id;

            if (($request->date_start != $request->date_end) || ($request->time_start != $request->time_end)) {
                $news['date_end'] = $request->date_end;
                $news['time_end'] = $request->time_end;
            }

            $news = $this->news->create($news);

            $news->category()->attach($request->category_id);

            if ($request->multi_images) {
                $news->news_images()->createMany($request->multi_images);
            }

            $newsTranslation                    = $request->only('title', 'author', 'copyright', 'intro', 'content', 'foot', 'image', 'youtube', 'file', 'slug', 'title_tag', 'meta_keywords', 'meta_description');
            $newsTranslation['meta_robots']     = is_null($request->meta_robots) ? null : implode(",", $request->meta_robots);
            $newsTranslation['meta_google_bot'] = is_null($request->meta_google_bot) ? null : implode(",", $request->meta_google_bot);
            $newsTranslation['news_id']         = $news->id;
            $newsTranslation['locale']          = config('app.locale');
            $newsTranslation                    = $this->newsTranslation->create($newsTranslation);

            ModelsNews::flushQueryCache(['news']);

            LogActivityHelper::addToLog([
                'module'      => 'news',
                'action'      => 'create',
                'description' => $request->title,
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
                'result'   => array('news' => $news, 'newsTranslation' => $newsTranslation)
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
        $data = $this->news->getByUuid($uuid);

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
        $data['category_name'] = 'category';
        $data['categories']    = $this->category->getAllCategoryRecursive();

        $news                  = $this->news->getNewsUuid($uuid);
        $data['news']          = $news["news"];
        $data['category_news'] = $news['category'];
        $data['images']        = $news['images'];

        $transData = array(
            ['locale', app()->getLocale()],
            ['news_id', $data['news']->id]
        );

        $transUuid = $this->newsTranslation->getUuidByIdAndLocale($transData);

        if (is_null($transUuid)) {
            return redirect()->route($this->route . 'language', ['news' => $uuid])->with('error', message_module($this->module, 'crud.edit_trans_fail'));
        }

        return view($this->view . 'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param string $uuid
     * @return mixed
     * @throws \Throwable
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update(UpdateRequest $request, string $uuid)
    {
        $news            = null;
        $newsTranslation = null;

        DB::transaction(function () use ($request, $uuid, &$news, &$newsTranslation) {
            $news             = $request->only('date_start', 'time_start', 'position', 'open_link', 'status', 'featured', 'template', 'viewed');
            $news['access']   = is_null($request->access) ? null : implode(",", $request->access);
            $news['featured'] = is_null($request->featured) ? null : implode(",", $request->featured);
            $news['user_id']  = auth()->user()->id;

            if (($request->date_start != $request->date_end) || ($request->time_start != $request->time_end)) {
                $news['date_end'] = $request->date_end;
                $news['time_end'] = $request->time_end;
            }

            $news = $this->news->update($news, $uuid);

            $news->category()->sync($request->category_id);

            $newsId = $this->news->getIdByUuid($uuid);

            $news->news_images()->delete();
            if ($request->multi_images) {
                $news->news_images()->createMany($request->multi_images);
            }

            $transData = array(
                ['locale', app()->getLocale()],
                ['news_id', $newsId]
            );

            $transUuid = $this->newsTranslation->getUuidByIdAndLocale($transData);

            $newsTranslation                    = $request->only('title', 'author', 'copyright', 'intro', 'content', 'foot', 'image', 'youtube', 'file', 'slug', 'title_tag', 'meta_keywords', 'meta_description');
            $newsTranslation['meta_robots']     = is_null($request->meta_robots) ? null : implode(",", $request->meta_robots);
            $newsTranslation['meta_google_bot'] = is_null($request->meta_google_bot) ? null : implode(",", $request->meta_google_bot);
            $newsTranslation['news_id']         = $news->id;
            $newsTranslation                    = $this->newsTranslation->update($newsTranslation, $transUuid);

            ModelsNews::flushQueryCache(['news']);

            LogActivityHelper::addToLog([
                'module'      => 'news',
                'action'      => 'edit',
                'description' => $request->title,
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['news' => $uuid]),
                'result'   => array('news' => $news, 'newsTranslation' => $newsTranslation)
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
        $data = $this->news->getByUuid($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'news',
            'action'      => 'delete',
            'description' => $data->title,
        ]);

        $result = $this->news->remove($uuid);
        ModelsNews::flushQueryCache(['news']);

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
        $news = $this->news->query();

        return Datatables::of($news)
            ->setRowClass(function ($news) {
                if (config('app.multi_language')) {
                    $translate = $this->translateRemaining($news->uuid);
                    return $translate["full"] ? 'text-default' : 'text-warning';
                } else {
                    return 'text-default';
                }
            })
            ->editColumn('title', function ($news) {
                $translate = $news->news_translation()->where('locale', config('app.locale'))->first();
                return Str::limit($translate->title ?? '', 50);
            })
            ->filterColumn('title', function(Builder $query ,$keyword) {
                $query->whereHas('news_translation', function (Builder $query) use ($keyword) {
                    $query->where('title', 'like', "%{$keyword}%");
                });
            })
            ->editColumn('image', function ($news) {
                return '<img height="30" src="' . $news->image . '" alt="' . $news->title . '">';
            })
            ->filterColumn('image', function(Builder $query ,$keyword) {
                $query->whereHas('news_translation', function (Builder $query) use ($keyword) {
                    $query->where('image', 'like', "%{$keyword}%");
                });
            })
            ->editColumn('category', function ($news) {
                $category = DB::table('category_news')
                    ->join('categories', 'categories.id', '=', 'category_news.category_id')
                    ->join('categories_translations', 'categories.id', '=', 'categories_translations.category_id')
                    ->where('news_id', $news->id)
                    ->where('locale', config('app.locale'))
                    ->get();

                $xhtml = '';
                foreach ($category as $item) {
                    $xhtml .= '<li>' . $item->name . '</li>';
                }
                return $xhtml;
            })
            ->filterColumn('category', function(Builder $query ,$keyword) {
                $query->whereHas('category', function (Builder $query) use ($keyword) {
                    $query->where('categories.id', $keyword);
                });
            })
            ->editColumn('status', function ($news) {
                $statuses = array();

                foreach (status() as $status) {
                    $statuses[$status->id]["id"]   = $status->id;
                    $statuses[$status->id]["name"] = $status->name;
                }
                return $statuses[$news->status]["name"];
            })
            ->editColumn('featured', function ($news) {
                $featureds = array();
                foreach (featured() as $featured) {
                    $featureds[$featured->id]["id"]   = $featured->id;
                    $featureds[$featured->id]["name"] = $featured->name;
                }

                $xhtml = '';
                foreach (explode(",", $news->featured) as $news_featured) {
                    $xhtml .= '<li>' . $featureds[$news_featured]["name"] . '</li>';
                }

                return $xhtml;
            })
            ->addColumn('actions', function ($news) {
                return view('administrator.modules.news.actions', ['uuid' => $news->uuid, 'news' => $this]);
            })
            ->rawColumns(['image', 'actions', 'status', 'featured', 'category'])
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
        $id = $this->news->getIdByUuid($uuid);

        $totalLanguage      = $this->language->countRow();
        $languageTranslated = $this->newsTranslation->getTotalTranslated('news_id', $id);
        $languageRemaining  = "<span class='pl-1'>($languageTranslated/$totalLanguage)</span>";

        $totalLocale      = $this->language->getAllLocale()->toArray();
        $localeTranslated = $this->newsTranslation->getLocaleTranslated('news_id', $id)->toArray();
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
        $data['news'] = $this->news->getByUuid($uuid);

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
        $news                    = $request->only('title', 'author', 'copyright', 'intro', 'content', 'foot', 'image', 'youtube', 'file', 'slug', 'title_tag', 'meta_keywords', 'meta_description', 'locale');
        $news['meta_robots']     = is_null($request->meta_robots) ? null : implode(",", $request->meta_robots);
        $news['meta_google_bot'] = is_null($request->meta_google_bot) ? null : implode(",", $request->meta_google_bot);
        $news['news_id']         = $this->news->getIdByUuid($uuid);

        $result = $this->newsTranslation->create($news);

        $translated_remaining = $this->translateRemaining($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'news',
            'action'      => 'translation',
            'description' => $request->title_origin . " - " . $request->title,
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
