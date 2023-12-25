<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Image\StoreRequest;
use App\Http\Requests\Administrator\Image\UpdateRequest;
use App\Http\Requests\Administrator\Image\TranslationRequest;
use App\Http\Resources\Image;
use App\Models\Image as ModelsImage;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Image\ImageTranslationRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Position\PositionRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request as RequestAjax;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class ImageController extends AdminController
{
    private $route = 'admin.image.';

    private $view = 'administrator.modules.image.';

    private $module = 'module.image';

    private $image;

    private $position;

    private $language;

    private $imageTranslation;

    /**
     * ImagesController constructor.
     * @param ImageRepository $image
     * @param LanguageRepository $language
     * @param PositionRepository $position
     * @param ImageTranslationRepository $imageTranslation
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ImageRepository $image,
                                LanguageRepository $language,
                                PositionRepository $position,
                                ImageTranslationRepository $imageTranslation)
    {
        parent::__construct();
        $this->middleware('permission:image_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:image_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:image_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:image_destroy', ['only' => ['destroy']]);

        $this->image            = $image;
        $this->position         = $position;
        $this->language         = $language;
        $this->imageTranslation = $imageTranslation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function index()
    {
        $data['position'] = $this->position->getAllPositionRecursive();

        if (Request::is('api*')) {
            $content = $this->image->getAllImageWithPosition();
            return new Image($content);
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
        $data['position']          = $this->position->getAllPositionRecursive();
        $data['root_position_max'] = $this->image->getMaxPosition(1);

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
        $image            = null;
        $imageTranslation = null;

        DB::transaction(function () use ($request, &$image, &$imageTranslation) {
            $image            = $request->only('position', 'open_link', 'position_id');
            $image['status']  = $request->status ?? 'off';
            $image['access']  = implode(",", $request->access);
            $image['user_id'] = auth()->user()->id;
            $image            = $this->image->create($image);

            $imageTranslation             = $request->only('name', 'script_code', 'image', 'link', 'video', 'description');
            $imageTranslation['image_id'] = $image->id;
            $imageTranslation['locale']   = config('app.locale');
            $imageTranslation             = $this->imageTranslation->create($imageTranslation);

            ModelsImage::flushQueryCache(['images']);

            LogActivityHelper::addToLog([
                'module'      => 'image',
                'action'      => 'create',
                'description' => $request->name
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
                'result'   => array('image' => $image, 'imageTranslation' => $imageTranslation)
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
        $data = $this->image->getByUuid($uuid);

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
        $data['position'] = $this->position->getAllPositionRecursive();
        $data['image']    = $this->image->getByUuid($uuid);

        $transData = array(
            ['locale', app()->getLocale()],
            ['image_id', $data['image']->id]
        );

        $transUuid = $this->imageTranslation->getUuidByIdAndLocale($transData);

        if (is_null($transUuid)) {
            return redirect()->route($this->route . 'language', ['image' => $uuid])->with('error', message_module($this->module, 'crud.edit_trans_fail'));
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
        $image            = null;
        $imageTranslation = null;

        DB::transaction(function () use ($request, $uuid, &$image, &$imageTranslation) {
            $image            = $request->only('position', 'open_link', 'position_id');
            $image['status']  = $request->status ?? 'off';
            $image['access']  = implode(",", $request->access);
            $image['user_id'] = auth()->user()->id;
            $image            = $this->image->update($image, $uuid);

            $imageId = $this->image->getIdByUuid($uuid);

            $transData = array(
                ['locale', app()->getLocale()],
                ['image_id', $imageId]
            );

            $transUuid = $this->imageTranslation->getUuidByIdAndLocale($transData);

            $imageTranslation             = $request->only('name', 'script_code', 'image', 'link', 'video', 'description');
            $imageTranslation['image_id'] = $image->id;
            $imageTranslation             = $this->imageTranslation->update($imageTranslation, $transUuid);

            ModelsImage::flushQueryCache(['images']);

            LogActivityHelper::addToLog([
                'module'      => 'image',
                'action'      => 'edit',
                'description' => $request->name
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['image' => $uuid]),
                'result'   => array('image' => $image, 'imageTranslation' => $imageTranslation)
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
        $data = $this->image->getByUuid($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'image',
            'action'      => 'delete',
            'description' => $data->name
        ]);

        $result = $this->image->remove($uuid);
        ModelsImage::flushQueryCache(['images']);

        return response()->json(
            [
                'status'  => 'success',
                'message' => message_module($this->module, 'crud.destroy_success'),
                'result'  => $result
            ], 200);
    }

    /**
     * Get position max of category after change parent category
     * @param RequestAjax $request
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function ajaxSelectPositionImages(RequestAjax $request): int
    {
        return $this->position->getMaxPosition($request->id);
    }

    /**
     * Process datatables ajax request.
     * @return mixed
     * @throws \Exception
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function dataTableIndex()
    {
        $image = $this->image->query();

        return Datatables::of($image)
            ->setRowClass(function ($image) {
                if (config('app.multi_language')) {
                    $translate = $this->translateRemaining($image->uuid);
                    return $translate["full"] ? 'text-default' : 'text-warning';
                } else {
                    return 'text-default';
                }
            })
            ->editColumn('status', function ($image) {
                if ($image->status == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';

                }
                return $xhtml;
            })
            ->editColumn('position', function ($image) {
                $position = DB::table('positions')
                    ->where('id', $image->position_id)
                    ->first();
                return $position->name ?? '';
            })
            ->filterColumn('position', function(Builder $query ,$keyword) {
                $query->whereHas('position_image', function (Builder $query) use ($keyword) {
                    $query->where('positions.id', $keyword);
                });
            })
            ->filterColumn('name', function(Builder $query ,$keyword) {
                $query->whereHas('images_translations', function (Builder $query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                });
            })
            ->addColumn('actions', function ($image) {
                return view('administrator.modules.image.actions', ['uuid' => $image->uuid, 'images' => $this]);
            })
            ->rawColumns(['actions', 'status', 'position_id'])
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
        $id = $this->image->getIdByUuid($uuid);

        $totalLanguage      = $this->language->countRow();
        $languageTranslated = $this->imageTranslation->getTotalTranslated('image_id', $id);
        $languageRemaining  = "<span class='pl-1'>($languageTranslated/$totalLanguage)</span>";

        $totalLocale      = $this->language->getAllLocale()->toArray();
        $localeTranslated = $this->imageTranslation->getLocaleTranslated('image_id', $id)->toArray();
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
        $data['image'] = $this->image->getByUuid($uuid);

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
        $image             = $request->only('name', 'script_code', 'image', 'link', 'video', 'description', 'locale');
        $image['image_id'] = $this->image->getIdByUuid($uuid);

        $result = $this->imageTranslation->create($image);

        $translated_remaining = $this->translateRemaining($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'image',
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
                    'redirect' => route($this->route . 'language', ['image' => $uuid]),
                    'result'   => $result
                ], 201);
        }
    }
}
