<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Product\StoreRequest;
use App\Http\Requests\Administrator\Product\TranslationRequest;
use App\Http\Requests\Administrator\Product\UpdateRequest;
use App\Http\Resources\Product;
use App\Models\Product as ModelsProduct;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Producer\ProducerRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductTranslationRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ProductController extends AdminController
{
    private $view = 'administrator.modules.product.';

    private $route = 'admin.product.';

    private $module = 'module.product';

    private $product;

    private $category;

    private $productTranslation;

    private $language;

    private $producer;

    private $attribute;

    /**
     * ProductController constructor.
     * @param LanguageRepository $language
     * @param ProductRepository $product
     * @param CategoryRepository $category
     * @param AttributeRepository $attribute
     * @param ProductTranslationRepository $productTranslation
     * @param ProducerRepository $producer
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(LanguageRepository $language,
                                ProductRepository $product,
                                CategoryRepository $category,
                                AttributeRepository $attribute,
                                ProductTranslationRepository $productTranslation,
                                ProducerRepository $producer)
    {
        parent::__construct();
        $this->middleware('permission:product_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:product_create', ['only' => ['create', 'store', 'language', 'translation']]);
        $this->middleware('permission:product_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product_destroy', ['only' => ['destroy']]);

        $this->language           = $language;
        $this->product            = $product;
        $this->category           = $category;
        $this->productTranslation = $productTranslation;
        $this->producer           = $producer;
        $this->attribute          = $attribute;
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
            $product = $this->product->getAll();
            return new Product($product);
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
        $data['attributes']    = $this->attribute->getAllAttributeRecursive();
        $data['categories'] = $this->category->getAllCategoryRecursive();

        $data['position']      = $this->product->getNewPosition();
        $data['producer']      = $this->producer->getAll();

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
        $product            = null;
        $productTranslation = null;

        DB::transaction(function () use ($request, &$product, &$productTranslation) {
            $product             = $request->only('date_start', 'time_start', 'position', 'open_link', 'status', 'featured', 'template', 'viewed', 'producer_id');
            $product['access']   = is_null($request->access) ? null : implode(",", $request->access);
            $product['featured'] = is_null($request->featured) ? null : implode(",", $request->featured);
            $product['user_id']  = auth()->user()->id;


            // if (($request->date_start != $request->date_end) || ($request->time_start != $request->time_end)) {
            //     $product['date_end'] = $request->date_end;
            //     $product['time_end'] = $request->time_end;
            // }

            $product = $this->product->create($product);

            $product->category()->attach($request->category_id);

            if ($request->multi_attribute) {
                $product->product_attribute()->createMany($request->multi_attribute);
            }

            $productTranslation                    = $request->only('name', 'price', 'discount','title', 'description', 'content', 'image', 'youtube', 'file', 'slug', 'title_tag', 'meta_keywords', 'meta_description');
            $productTranslation['meta_robots']     = is_null($request->meta_robots) ? null : implode(",", $request->meta_robots);
            $productTranslation['meta_google_bot'] = is_null($request->meta_google_bot) ? null : implode(",", $request->meta_google_bot);
            $productTranslation['product_id']      = $product->id;
            $productTranslation['locale']          = config('app.locale');
            $productTranslation                    = $this->productTranslation->create($productTranslation);

            ModelsProduct::flushQueryCache(['products']);

            LogActivityHelper::addToLog([
                'module'      => 'product',
                'action'      => 'create',
                'description' => $request->name,
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
                'result'   => array('product' => $product, 'productTranslation' => $productTranslation)
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
        $data = $this->product->getByUuid($uuid);

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
        $data['categories'] = $this->category->getAllCategoryRecursive();
        $data['producer']      = $this->producer->getAll();

        $data['parent'] = $this->productTranslation->getAllProductRecursive();

        $product              = $this->product->getProductUuid($uuid);

        $data['product']          = $product["product"];
        $data['attribute']        = $product['attribute'];
        $data['category_product'] = $product['category'];
        $data['images']           = $product['images'];

        $transData = array(
            ['locale', app()->getLocale()],
            ['product_id', $data['product']->id]
        );

        $transUuid = $this->productTranslation->getUuidByIdAndLocale($transData);

        if (is_null($transUuid)) {
            return redirect()->route($this->route . 'language', ['product' => $uuid])->with('error', message_module($this->module, 'crud.edit_trans_fail'));
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
        $product            = null;
        $productTranslation = null;

        DB::transaction(function () use ($request, $uuid, &$product, &$productTranslation) {
            $product             = $request->only('date_start', 'time_start', 'position', 'open_link', 'status', 'featured', 'template', 'viewed', 'producer_id');
            $product['access']   = is_null($request->access) ? null : implode(",", $request->access);
            $product['featured'] = is_null($request->featured) ? null : implode(",", $request->featured);
            $product['user_id']  = auth()->user()->id;

            if (($request->date_start != $request->date_end) || ($request->time_start != $request->time_end)) {
                $product['date_end'] = $request->date_end;
                $product['time_end'] = $request->time_end;
            }

            $product = $this->product->update($product, $uuid);

            $product->category()->sync($request->category_id);

            $productId = $this->product->getIdByUuid($uuid);

            $product->product_attribute()->delete();
            if ($request->multi_attribute) {
                $product->product_attribute()->createMany($request->multi_attribute);
            }
            $product->product_images()->delete();
            if ($request->multi_images) {
                $product->product_images()->createMany($request->multi_images);
            }

            $transData = array(
                ['locale', app()->getLocale()],
                ['product_id', $productId]
            );

            $transUuid = $this->productTranslation->getUuidByIdAndLocale($transData);

            $productTranslation                    = $request->only('name', 'price', 'discount', 'title','description', 'content', 'image', 'youtube', 'file', 'slug', 'title_tag', 'meta_keywords', 'meta_description');
            $productTranslation['meta_robots']     = is_null($request->meta_robots) ? null : implode(",", $request->meta_robots);
            $productTranslation['meta_google_bot'] = is_null($request->meta_google_bot) ? null : implode(",", $request->meta_google_bot);
            $productTranslation['product_id']      = $product->id;
            $productTranslation                    = $this->productTranslation->update($productTranslation, $transUuid);

            ModelsProduct::flushQueryCache(['products']);

            LogActivityHelper::addToLog([
                'module'      => 'product',
                'action'      => 'edit',
                'description' => $request->name,
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['product' => $uuid]),
                'result'   => array('product' => $product, 'productTranslation' => $productTranslation)
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
        $data = $this->product->getByUuid($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'product',
            'action'      => 'delete',
            'description' => $data->title,
        ]);

        $result = $this->product->remove($uuid);

        ModelsProduct::flushQueryCache(['products']);

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
        $product = $this->product->query();

        return Datatables::of($product)
            ->setRowClass(function ($product) {
                if (config('app.multi_language')) {
                    $translate = $this->translateRemaining($product->uuid);
                    return $translate["full"] ? 'text-default' : 'text-warning';
                } else {
                    return 'text-default';
                }
            })
            ->editColumn('name', function ($product) {
                $translate = $product->product_translation()->where('locale', config('app.locale'))->first();
                return Str::limit($translate->name ?? '', 50);
            })
            ->filterColumn('name', function (Builder $query, $keyword) {
                $query->whereHas('product_translation', function (Builder $query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                });
            })
            ->editColumn('image', function ($product) {
                return '<img height="30" src="' . $product->image . '" alt="' . $product->title . '">';
            })
            ->filterColumn('image', function (Builder $query, $keyword) {
                $query->whereHas('product_translation', function (Builder $query) use ($keyword) {
                    $query->where('image', 'like', "%{$keyword}%");
                });
            })
            ->editColumn('category', function ($product) {
                $category = DB::table('category_products')
                    ->join('categories', 'categories.id', '=', 'category_products.category_id')
                    ->join('categories_translations', 'categories.id', '=', 'categories_translations.category_id')
                    ->where('product_id', $product->id)
                    ->where('locale', config('app.locale'))
                    ->get();

                $xhtml = '';
                foreach ($category as $item) {
                    $xhtml .= '<li>' . $item->name . '</li>';
                }
                return $xhtml;
            })
            ->filterColumn('category', function (Builder $query, $keyword) {
                $query->whereHas('category', function (Builder $query) use ($keyword) {
                    $query->where('categories.id', $keyword);
                });
            })
            ->editColumn('status', function ($product) {
                $statuses = array();

                foreach (status() as $status) {
                    $statuses[$status->id]["id"]   = $status->id;
                    $statuses[$status->id]["name"] = $status->name;
                }
                return $statuses[$product->status]["name"];
            })
            ->editColumn('featured', function ($product) {
                $featureds = array();
                foreach (featured() as $featured) {
                    $featureds[$featured->id]["id"]   = $featured->id;
                    $featureds[$featured->id]["name"] = $featured->name;
                }

                $xhtml = '';
                foreach (explode(",", $product->featured) as $product_featured) {
                    $xhtml .= '<li>' . $featureds[$product_featured]["name"] . '</li>';
                }

                return $xhtml;
            })
            ->addColumn('actions', function ($product) {
                return view('administrator.modules.product.actions', ['uuid' => $product->uuid, 'product' => $this]);
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
        $id = $this->product->getIdByUuid($uuid);

        $totalLanguage      = $this->language->countRow();
        $languageTranslated = $this->productTranslation->getTotalTranslated('product_id', $id);
        $languageRemaining  = "<span class='pl-1'>($languageTranslated/$totalLanguage)</span>";

        $totalLocale      = $this->language->getAllLocale()->toArray();
        $localeTranslated = $this->productTranslation->getLocaleTranslated('product_id', $id)->toArray();
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
        $data['product'] = $this->product->getByUuid($uuid);

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
        $product                    = $request->only('name', 'price', 'discount', 'description', 'content', 'image', 'youtube', 'file', 'slug', 'title_tag', 'meta_keywords', 'meta_description', 'locale');
        $product['meta_robots']     = is_null($request->meta_robots) ? null : implode(",", $request->meta_robots);
        $product['meta_google_bot'] = is_null($request->meta_google_bot) ? null : implode(",", $request->meta_google_bot);
        $product['product_id']      = $this->product->getIdByUuid($uuid);

        $result = $this->productTranslation->create($product);

        $translated_remaining = $this->translateRemaining($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'product',
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
                    'redirect' => route($this->route . 'language', ['product' => $uuid]),
                    'result'   => $result
                ], 201);
        }
    }
}
