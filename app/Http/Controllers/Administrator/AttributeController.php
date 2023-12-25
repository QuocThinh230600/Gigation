<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Attribute\StoreRequest;
use App\Http\Requests\Administrator\Attribute\TranslationRequest;
use App\Http\Requests\Administrator\Attribute\UpdateRequest;
use App\Models\Attribute;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Attribute\AttributeTranslationRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request as RequestAjax;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class AttributeController extends AdminController
{
    private $view = 'administrator.modules.attribute.';

    private $route = 'admin.attribute.';

    private $module = 'module.attribute';

    private $attribute;

    private $attributeTranslation;

    private $language;

    /**
     * ProductAttributeController constructor.
     * @param AttributeRepository $attribute
     * @param AttributeTranslationRepository $attributeTranslation
     * @param LanguageRepository $language
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(AttributeRepository $attribute,
                                AttributeTranslationRepository $attributeTranslation,
                                LanguageRepository $language)
    {
        parent::__construct();
        $this->middleware('permission:attribute_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:attribute_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:attribute_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:attribute_destroy', ['only' => ['destroy']]);
        $this->attribute            = $attribute;
        $this->attributeTranslation = $attributeTranslation;
        $this->language             = $language;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function index()
    {
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
        $data['root_position_max'] = $this->attribute->getMaxPosition(1);
        $data['languages']         = $this->language->getAll();
        $data['parent']            = $this->attribute->getAllAttributeRecursive();

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
        $attribute            = null;
        $attributeTranslation = null;

        DB::transaction(function () use ($request, &$attribute, &$attributeTranslation) {
            $attribute            = $request->only('position', 'parent_id');
            $attribute['status']  = $request->status ?? 'off';
            $attribute['user_id'] = auth()->user()->id;
            $attribute            = $this->attribute->create($attribute);

            $attributeTranslation                 = $request->only('name', 'description');
            $attributeTranslation['attribute_id'] = $attribute->id;
            $attributeTranslation['locale']       = config('app.locale');
            $attributeTranslation                 = $this->attributeTranslation->create($attributeTranslation);

            Attribute::flushQueryCache(['attributes']);

            LogActivityHelper::addToLog([
                'module'      => 'attribute',
                'action'      => 'create',
                'description' => $request->name,
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
                'result'   => array('attribute' => $attribute, 'attributeTranslation' => $attributeTranslation)
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
        $data = $this->attribute->getByUuid($uuid);

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
        $data['attribute'] = $this->attribute->getByUuid($uuid);

        $id             = $this->attribute->getIdByUuid($uuid);
        $data['parent'] = $this->attribute->getAllAttributeRecursiveToUpdate($id);

        $transData = array(
            ['locale', app()->getLocale()],
            ['attribute_id', $data['attribute']->id]
        );

        $transUuid = $this->attributeTranslation->getUuidByIdAndLocale($transData);

        if (is_null($transUuid)) {
            return redirect()->route($this->route . 'language', ['attribute' => $uuid])->with('error', message_module($this->module, 'crud.edit_trans_fail'));
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
        $attribute            = null;
        $attributeTranslation = null;

        DB::transaction(function () use ($request, $uuid, &$attribute, &$attributeTranslation) {
            $attribute            = $request->only('position', 'parent_id');
            $attribute['status']  = $request->status ?? 'off';
            $attribute['user_id'] = auth()->user()->id;
            $attribute            = $this->attribute->update($attribute, $uuid);

            $attributeId = $this->attribute->getIdByUuid($uuid);

            $transData = array(
                ['locale', app()->getLocale()],
                ['attribute_id', $attributeId]
            );

            $transUuid = $this->attributeTranslation->getUuidByIdAndLocale($transData);

            $attributeTranslation                 = $request->only('name', 'description');
            $attributeTranslation['attribute_id'] = $attribute->id;
            $attributeTranslation['locale']       = config('app.locale');
            $attributeTranslation                 = $this->attributeTranslation->update($attributeTranslation, $transUuid);

            Attribute::flushQueryCache(['attributes']);

            LogActivityHelper::addToLog([
                'module'      => 'attribute',
                'action'      => 'create',
                'description' => $request->name,
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['attribute' => $uuid]),
                'result'   => array('attribute' => $attribute, 'attributeTranslation' => $attributeTranslation)
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
        if ($this->attribute->countChildToDelete($uuid)) {

            $data = $this->attribute->getByUuid($uuid);

            LogActivityHelper::addToLog([
                'module'      => 'category',
                'action'      => 'delete',
                'description' => $data->name,
            ]);

            $result = $this->attribute->remove($uuid);
            Attribute::flushQueryCache(['attributes']);

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
     * Process datatables ajax request.
     * @return mixed
     * @throws \Exception
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function dataTableIndex()
    {
        $attribute = $this->attribute->query()->whereNull('attributes.deleted_at');

        return Datatables::of($attribute)
            ->setRowClass(function ($attribute) {
                if (config('app.multi_language')) {
                    $translate = $this->translateRemaining($attribute->uuid);
                    return $translate["full"] ? 'text-default' : 'text-warning';
                } else {
                    return 'text-default';
                }
            })
            ->filterColumn('name', function(Builder $query ,$keyword) {
                $query->whereHas('attribute_translation', function (Builder $query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                });
            })
            ->editColumn('parent', function ($attribute) {
                $attribute_parent = DB::table('attributes')
                    ->select('attributes.id', 'attributes_translations.name', 'parent_id', 'status')
                    ->join('attributes_translations', 'attributes.id', '=', 'attributes_translations.attribute_id')
                    ->where('attributes.id', $attribute->parent_id)->first();

                if ($attribute->parent_id == 0) {
                    return 'NULL';
                } else {
                    return $attribute_parent->name;
                }
            })
            ->filterColumn('parent', function(Builder $query ,$keyword) {
                $query->whereHas('attribute_translation', function (Builder $query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                });
            })
            ->editColumn('status', function ($attribute) {
                if ($attribute->status == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';

                }
                return $xhtml;
            })
            ->addColumn('actions', function ($attribute) {
                return view('administrator.modules.attribute.actions', ['uuid' => $attribute->uuid, 'attribute' => $this]);
            })
            ->rawColumns(['actions', 'status'])
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
        $id = $this->attribute->getIdByUuid($uuid);

        $totalLanguage      = $this->language->countRow();
        $languageTranslated = $this->attributeTranslation->getTotalTranslated('attribute_id', $id);
        $languageRemaining  = "<span class='pl-1'>($languageTranslated/$totalLanguage)</span>";

        $totalLocale      = $this->language->getAllLocale()->toArray();
        $localeTranslated = $this->attributeTranslation->getLocaleTranslated('attribute_id', $id)->toArray();
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
        $data['attribute'] = $this->attribute->getByUuid($uuid);

        $locale_current[]          = app()->getLocale();
        $data['languages_current'] = $this->language->getLanguageByLocale($locale_current);

        $translated_remaining        = $this->translateRemaining($uuid);
        $locale_remaining            = $translated_remaining['locale'];
        $data['languages_remaining'] = $this->language->getLanguageByLocale($locale_remaining);

        return view($this->view . 'translation', $data);
    }

    /**
     * Get position max of category after change parent category
     * @param RequestAjax $request
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function ajaxSelectCategory(RequestAjax $request): int
    {
        return $this->attribute->getMaxPosition($request->id);
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
        $attribute                 = $request->only('name', 'description', 'locale');
        $attribute['attribute_id'] = $this->attribute->getIdByUuid($uuid);

        $result = $this->attributeTranslation->create($attribute);

        $translated_remaining = $this->translateRemaining($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'attribute',
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
                    'redirect' => route($this->route . 'attribute', ['attribute' => $uuid]),
                    'result'   => $result
                ], 201);
        }
    }

    /**
     * Get position max of category after change parent category
     * @param RequestAjax $request
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function ajaxSelectAttribute(RequestAjax $request): int
    {
        return $this->attribute->getMaxPosition($request->id);
    }
}
