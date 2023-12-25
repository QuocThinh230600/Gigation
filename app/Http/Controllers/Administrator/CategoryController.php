<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Category\StoreRequest;
use App\Http\Requests\Administrator\Category\TranslationRequest;
use App\Http\Requests\Administrator\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Advantages;
use App\Models\Product;
use App\Repositories\Advantages\AdvantagesRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryTranslationRepository;
use App\Repositories\Language\LanguageRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use \Illuminate\Http\Request as RequestAjax;

class CategoryController extends AdminController
{
    private $view = 'administrator.modules.category.';

    private $route = 'admin.category.';

    private $module = 'module.category';

    private $category;

    private $categoryTranslation;

    private $advantages;

    private $language;

    /**
     * CategoryController constructor.
     * @param LanguageRepository $language
     * @param CategoryRepository $category
     * @param CategoryTranslationRepository $categoryTranslation
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(LanguageRepository $language,
                                CategoryRepository $category,
                                CategoryTranslationRepository $categoryTranslation,
                                AdvantagesRepository $advantages)
    {
        parent::__construct();
        $this->middleware('permission:category_index', ['only' => ['show', 'index']]);
        $this->middleware('permission:category_create', ['only' => ['create', 'store', 'language', 'translation']]);
        $this->middleware('permission:category_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category_destroy', ['only' => ['destroy']]);

        $this->language            = $language;
        $this->category            = $category;
        $this->categoryTranslation = $categoryTranslation;
        $this->advantages          = $advantages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function index()
    {
        $data['classCategory'] = $this;
        $data['categories']    = $this->category->getAllCategoryRecursive();

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
        $data['root_position_max'] = $this->category->getMaxPosition(1);
        $data['languages']         = $this->language->getAll();
        $data['parent']            = $this->category->getAllCategoryRecursive();

        return view($this->view . 'create', $data);
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
        $category            = null;
        $categoryTranslation = null;

        DB::transaction(function () use ($request, &$category, &$categoryTranslation) {
            $category            = $request->only('icon', 'parent_id', 'position', 'access', 'open_link');
            $category['status']  = $request->status ?? 'off';
            $category['access']  = is_null($request->access) ? null : implode(",", $request->access);
            $category['user_id'] = auth()->user()->id;
            $category            = $this->category->create($category);

            Category::flushQueryCache(['categories']);

            $categoryTranslation                    = $request->only('name', 'title', 'content', 'description', 'image', 'link', 'slug', 'title_tag', 'meta_keywords', 'meta_description');
            $categoryTranslation['meta_robots']     = is_null($request->meta_robots) ? null : implode(",", $request->meta_robots);
            $categoryTranslation['meta_google_bot'] = is_null($request->meta_google_bot) ? null : implode(",", $request->meta_google_bot);
            $categoryTranslation['category_id']     = $category->id;
            $categoryTranslation['locale']          = config('app.locale');
            $categoryTranslation                    = $this->categoryTranslation->create($categoryTranslation);

            LogActivityHelper::addToLog([
                'module'      => 'category',
                'action'      => 'create',
                'description' => $request->name,
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
                'result'   => array('category' => $category, 'categoryTranslation' => $categoryTranslation)
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
        $data = $this->category->getByUuid($uuid);

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
        $data['category'] = $this->category->getByUuid($uuid);

        $id             = $this->category->getIdByUuid($uuid);
        $data['parent'] = $this->category->getAllCategoryRecursiveToUpdate($id);

        $transData = array(
            ['locale', app()->getLocale()],
            ['category_id', $data['category']->id]
        );

        $transUuid = $this->categoryTranslation->getUuidByIdAndLocale($transData);

        if (is_null($transUuid)) {
            return redirect()->route($this->route . 'language', ['category' => $uuid])->with('error', message_module($this->module, 'crud.edit_trans_fail'));
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
        $category            = null;
        $categoryTranslation = null;

        DB::transaction(function () use ($request, $uuid, &$category, &$categoryTranslation) {
            $category            = $request->only('icon', 'parent_id', 'position', 'access', 'open_link');
            $category['status']  = $request->status ?? 'off';
            $category['access']  = is_null($request->access) ? null : implode(",", $request->access);
            $category['user_id'] = auth()->user()->id;
            $category            = $this->category->update($category, $uuid);

            $categoryId = $this->category->getIdByUuid($uuid);

            $transData = array(
                ['locale', app()->getLocale()],
                ['category_id', $categoryId]
            );
            Category::flushQueryCache(['categories']);
            $transUuid = $this->categoryTranslation->getUuidByIdAndLocale($transData);

            $categoryTranslation                    = $request->only('name',  'title', 'content', 'description', 'image', 'link', 'slug', 'title_tag', 'meta_keywords', 'meta_description');
            $categoryTranslation['meta_robots']     = is_null($request->meta_robots) ? null : implode(",", $request->meta_robots);
            $categoryTranslation['meta_google_bot'] = is_null($request->meta_google_bot) ? null : implode(",", $request->meta_google_bot);
            $categoryTranslation['category_id']     = $categoryId;
            $categoryTranslation                    = $this->categoryTranslation->update($categoryTranslation, $transUuid);

            LogActivityHelper::addToLog([
                'module'      => 'category',
                'action'      => 'edit',
                'description' => $request->name,
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['category' => $uuid]),
                'result'   => array('category' => $category, 'categoryTranslation' => $categoryTranslation)
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
        if ($this->category->countChildToDelete($uuid)) {

            $data = $this->category->getByUuid($uuid);

            LogActivityHelper::addToLog([
                'module'      => 'category',
                'action'      => 'delete',
                'description' => $data->name,
            ]);

            // dd($data->advantages()->get());
            foreach($data->advantages()->get() as $item)
            {
                $advantages = $this->advantages->remove($item->uuid);
            }

            Advantages::flushQueryCache(['advantages']);

            $result = $this->category->remove($uuid);
            Category::flushQueryCache(['categories']);


            return response()->json(
                [
                    'status'  => 'success',
                    'message' => message_module($this->module, 'crud.destroy_success'),
                    'result'  => $result
                ], 200);
        } else {
            return response()->json(
                [
                    'status'  => 'error',
                    'message' => message_module($this->module, 'category.category_not_exist_child'),
                ], 200);
        }
    }

    /**
     * Display language translation template
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function language(string $uuid)
    {
        $data['category'] = $this->category->getByUuid($uuid);

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
        $category                    = $request->only('name', 'description', 'image', 'link', 'slug', 'title_tag', 'meta_keywords', 'meta_description', 'locale');
        $category['meta_robots']     = is_null($request->meta_robots) ? null : implode(",", $request->meta_robots);
        $category['meta_google_bot'] = is_null($request->meta_google_bot) ? null : implode(",", $request->meta_google_bot);
        $category['category_id']     = $this->category->getIdByUuid($uuid);

        $result = $this->categoryTranslation->create($category);

        $translated_remaining = $this->translateRemaining($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'category',
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
                    'redirect' => route($this->route . 'language', ['category' => $uuid]),
                    'result'   => $result
                ], 201);
        }
    }

    /**
     * Number of languages ​​remaining after the data has been created
     * @param string $uuid
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function translateRemaining(string $uuid): array
    {
        $id = $this->category->getIdByUuid($uuid);

        $totalLanguage      = $this->language->countRow();
        $languageTranslated = $this->categoryTranslation->getTotalTranslated('category_id', $id);
        $languageRemaining  = "<span class='pl-1'>($languageTranslated/$totalLanguage)</span>";

        $totalLocale      = $this->language->getAllLocale()->toArray();
        $localeTranslated = $this->categoryTranslation->getLocaleTranslated('category_id', $id)->toArray();
        $localeRemaining  = array_diff($totalLocale, $localeTranslated);

        return [
            'language' => $languageRemaining,
            'locale'   => $localeRemaining,
            'full'     => $languageTranslated == $totalLanguage
        ];
    }

    /**
     * Get position max of category after change parent category
     * @param RequestAjax $request
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function ajaxSelectCategory(RequestAjax $request): int
    {
        return $this->category->getMaxPosition($request->id);
    }

    /**
     * Get position of category
     * @param RequestAjax $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function ajaxTableCategory(RequestAjax $request)
    {
        $id       = $request->id;
        $position = ($request->position <= 0) ? 1 : $request->position;

        $this->category->updatePositionTable($id, $position);

        LogActivityHelper::addToLog([
            'module'      => 'category',
            'action'      => 'update',
            'description' => "Position: $position of ID: $id",
        ]);

        return response()->json(
            [
                'status'  => 'success',
                'message' => message('ajax.table_category_position')
            ], 200);
    }
}
