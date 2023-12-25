<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Producer\StoreRequest;
use App\Http\Requests\Administrator\Producer\TranslationRequest;
use App\Http\Requests\Administrator\Producer\UpdateRequest;
use App\Http\Resources\Producer;
use App\Models\Producer as ModelsProducer;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Producer\ProducerRepository;
use App\Repositories\Producer\ProducerTranslationRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class ProducerController extends AdminController
{
    private $view = 'administrator.modules.producer.';

    private $route = 'admin.producer.';

    private $module = 'module.producer';

    private $producer;

    private $producerTranslation;

    private $language;

    /**
     * ProducerController constructor.
     * @param ProducerRepository $producer
     * @param ProducerTranslationRepository $producerTranslation
     * @param LanguageRepository $language
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ProducerRepository $producer,
                                ProducerTranslationRepository $producerTranslation,
                                LanguageRepository $language)
    {
        parent::__construct();
        $this->middleware('permission:producer_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:producer_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:producer_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:producer_destroy', ['only' => ['destroy']]);
        $this->producer            = $producer;
        $this->producerTranslation = $producerTranslation;
        $this->language            = $language;
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
            $producer = $this->producer->getAll();
            return new Producer($producer);
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
        $producer            = null;
        $producerTranslation = null;

        DB::transaction(function () use ($request, &$producer, &$producerTranslation) {
            $producer = $this->producer->create(
                [
                    'image'   => $request->image,
                    'status'  => $request->status ?? 'off',
                    'user_id' => auth()->user()->id
                ]
            );

            $producerTranslation                = $request->except(['_token', '_method', 'image', 'status']);
            $producerTranslation['producer_id'] = $producer->id;
            $producerTranslation['locale']      = config('app.locale');
            $producerTranslation                = $this->producerTranslation->create($producerTranslation);

            ModelsProducer::flushQueryCache(['producers']);

            LogActivityHelper::addToLog([
                'module'      => 'producer',
                'action'      => 'create',
                'description' => $request->name
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
                'result'   => array('producer' => $producer, 'producer_translation' => $producerTranslation)
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
        $data = $this->producer->getByUuid($uuid);

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
        $data['producer'] = $this->producer->getByUuid($uuid);

        $transData = array(
            ['locale', app()->getLocale()],
            ['producer_id', $data['producer']->id]
        );

        $transUuid = $this->producerTranslation->getUuidByIdAndLocale($transData);

        if (is_null($transUuid)) {
            return redirect()->route($this->route . 'language', ['producer' => $uuid])->with('error', message_module($this->module, 'crud.edit_trans_fail'));
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
        $producer            = null;
        $producerTranslation = null;

        DB::transaction(function () use ($request, $uuid, &$producer, &$producerTranslation) {
            $producer = $this->producer->update(
                [
                    'image'   => $request->image,
                    'status'  => $request->status ?? 'off',
                    'user_id' => auth()->user()->id
                ], $uuid
            );

            $producerId = $this->producer->getIdByUuid($uuid);

            $transData = array(
                ['locale', app()->getLocale()],
                ['producer_id', $producerId]
            );

            $transUuid = $this->producerTranslation->getUuidByIdAndLocale($transData);

            $producerTranslation                = $request->except(['_token', '_method', 'image', 'status']);
            $producerTranslation['producer_id'] = $producer->id;
            $producerTranslation                = $this->producerTranslation->update($producerTranslation, $transUuid);

            ModelsProducer::flushQueryCache(['producers']);

            LogActivityHelper::addToLog([
                'module'      => 'producer',
                'action'      => 'edit',
                'description' => $request->name
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['producer' => $uuid]),
                'result'   => array('producer' => $producer, 'pageTranslation' => $producerTranslation)
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
        $data = $this->producer->getByUuid($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'producer',
            'action'      => 'delete',
            'description' => $data->name,
        ]);

        $result = $this->producer->remove($uuid);
        ModelsProducer::flushQueryCache(['producers']);

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
        $producer = $this->producer->query();

        return Datatables::of($producer)
            ->setRowClass(function ($producer) {
                if (config('app.multi_language')) {
                    $translate = $this->translateRemaining($producer->uuid);
                    return $translate["full"] ? 'text-default' : 'text-warning';
                } else {
                    return 'text-default';
                }
            })
            ->editColumn('status', function ($producer) {
                if ($producer->status == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';

                }
                return $xhtml;
            })
            ->addColumn('actions', function ($producer) {
                return view('administrator.modules.producer.actions', ['uuid' => $producer->uuid, 'producer' => $this]);
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
        $id = $this->producer->getIdByUuid($uuid);

        $totalLanguage      = $this->language->countRow();
        $languageTranslated = $this->producerTranslation->getTotalTranslated('producer_id', $id);
        $languageRemaining  = "<span class='pl-1'>($languageTranslated/$totalLanguage)</span>";

        $totalLocale      = $this->language->getAllLocale()->toArray();
        $localeTranslated = $this->producerTranslation->getLocaleTranslated('producer_id', $id)->toArray();
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
        $data['producer'] = $this->producer->getByUuid($uuid);

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
        $producer                = $request->only('name', 'address', 'phone', 'email', 'description', 'locale');
        $producer['producer_id'] = $this->producer->getIdByUuid($uuid);

        $result = $this->producerTranslation->create($producer);

        $translated_remaining = $this->translateRemaining($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'producer',
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
                    'redirect' => route($this->route . 'producer', ['producer' => $uuid]),
                    'result'   => $result
                ], 201);
        }
    }
}
