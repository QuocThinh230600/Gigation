<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Language\StoreRequest;
use App\Http\Requests\Administrator\Language\UpdateRequest;
use App\Http\Resources\Language;
use App\Repositories\Language\LanguageRepository;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class LanguageController extends AdminController
{
    private $view = 'administrator.modules.language.';

    private $route = 'admin.language.';

    private $module = 'module.language';

    private $language;

    /**
     * LanguageController constructor.
     * @param LanguageRepository $language
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(LanguageRepository $language)
    {
        parent::__construct();
        $this->middleware('permission:language_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:language_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:language_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:language_destroy', ['only' => ['destroy']]);
        $this->language = $language;
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
            $languages = $this->language->getAll();
            return new Language($languages);
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
        $data['default'] = $this->language->checkLanguageDefault();

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
        $data            = $request->except(['_token', '_method']);
        $data['status']  = $request->status ?? 'off';
        $data['default'] = $request->default ?? 'off';
        $data['user_id'] = auth()->user()->id;
        $result          = $this->language->create($data);

        LogActivityHelper::addToLog([
            'module'      => 'language',
            'action'      => 'create',
            'description' => $request->name
        ]);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
                'result'   => $result
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
        $result = $this->language->getByUuid($uuid);

        return response()->json(
            [
                'status' => 'success',
                'result' => $result
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
        $languageCurrent = $this->language->checkLanguageCurrent();

        if ($languageCurrent->uuid == $uuid) {
            return redirect()->route($this->route . 'index')->with('warning', message('language.no_edit_language_website'));
        }

        $data['language'] = $this->language->getByUuid($uuid);

        $data['default'] = $this->language->checkLanguageDefaultByUuid($uuid);

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
        $languageCurrent = $this->language->checkLanguageCurrent();

        if ($languageCurrent->uuid == $uuid) {
            return redirect()->route($this->route . 'index')->with('warning', message('language.no_edit_language_website'));
        }

        $data            = $request->except(['_token', '_method']);
        $data['status']  = $request->status ?? 'off';
        $data['default'] = $request->default ?? 'off';
        $data['user_id'] = auth()->user()->id;
        $result          = $this->language->update($data, $uuid);

        LogActivityHelper::addToLog([
            'module'      => 'language',
            'action'      => 'edit',
            'description' => $request->name
        ]);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['language' => $uuid]),
                'result'   => $result
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function destroy($uuid)
    {
        $languageCurrent = $this->language->checkLanguageCurrent();

        if ($languageCurrent->uuid == $uuid) {
            return response()->json(
                [
                    'status'   => 'warning',
                    'message'  => message('language.no_delete_language_website'),
                    'redirect' => route($this->route . 'index'),
                ]);
        }

        $checkLanguage = $this->language->checkLanguageDefaultByUuid($uuid);

        if ($checkLanguage) {
            return response()->json(
                [
                    'status'   => 'warning',
                    'message'  => message('language.no_delete_language'),
                    'redirect' => route($this->route . 'index'),
                ]);
        } else {
            $data = $this->language->getByUuid($uuid);

            LogActivityHelper::addToLog([
                'module'      => 'language',
                'action'      => 'delete',
                'description' => $data->name
            ]);

            $result = $this->language->remove($uuid);

            return response()->json(
                [
                    'status'   => 'success',
                    'message'  => message_module($this->module, 'crud.destroy_success'),
                    'result'   => $result,
                    'redirect' => route($this->route . 'index'),
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
        $language = $this->language->query();

        return Datatables::of($language)
            ->editColumn('name', function ($language) {
                return $language->name . " ($language->locale) ";
            })
            ->editColumn('flag', function ($language) {
                return '<img height="19" src="' . $language->flag . '" alt="' . $language->name . '">';
            })
            ->editColumn('status', function ($language) {
                if ($language->status == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';

                }
                return $xhtml;
            })
            ->editColumn('default', function ($language) {
                if ($language->default == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.default_yes') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.default_no') . '</span>';

                }
                return $xhtml;
            })
            ->addColumn('actions', 'administrator.modules.language.actions')
            ->rawColumns(['status', 'actions', 'flag', 'default'])
            ->addIndexColumn()
            ->make(true);
    }
}
