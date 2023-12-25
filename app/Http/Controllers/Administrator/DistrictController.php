<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\District\StoreRequest;
use App\Http\Requests\Administrator\District\UpdateRequest;
use App\Http\Resources\District;
use App\Models\District as ModelsDistrict;
use App\Repositories\District\DistrictRepository;
use App\Repositories\Province\ProvinceRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class DistrictController extends AdminController
{
    private $view = 'administrator.modules.district.';

    private $route = 'admin.district.';

    private $module = 'module.district';

    private $province;

    private $district;

    /**
     * DistrictController constructor.
     * @param ProvinceRepository $province
     * @param DistrictRepository $district
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ProvinceRepository $province,
                                DistrictRepository $district)
    {
        parent::__construct();
        $this->middleware('permission:district_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:district_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:district_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:district_destroy', ['only' => ['destroy']]);
        $this->province = $province;
        $this->district = $district;
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
            $district = $this->district->getAll();
            return new District($district);
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
        $data['provinces'] = $this->province->getAll();
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
        $data             = $request->except(['_token', '_method']);
        $data['status']   = $request->status ?? 'off';
        $data['featured'] = $request->default ?? 'off';
        $result           = $this->district->create($data);

        ModelsDistrict::flushQueryCache(['districts']);

        LogActivityHelper::addToLog([
            'module'      => 'district',
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
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function show(int $id)
    {
        $result = $this->district->getById($id);

        return response()->json(
            [
                'status' => 'success',
                'result' => $result
            ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function edit(int $id)
    {
        $data['provinces'] = $this->province->getAll();
        $data['district']  = $this->district->getById($id);

        return view($this->view . 'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update(UpdateRequest $request, int $id)
    {
        $data             = $request->except(['_token', '_method']);
        $data['status']   = $request->status ?? 'off';
        $data['featured'] = $request->featured ?? 'off';
        $result           = $this->district->update($data, $id, false);

        ModelsDistrict::flushQueryCache(['districts']);

        LogActivityHelper::addToLog([
            'module'      => 'district',
            'action'      => 'edit',
            'description' => $request->name
        ]);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['district' => $id]),
                'result'   => $result
            ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function destroy(int $id)
    {
        $data = $this->district->getById($id);

        LogActivityHelper::addToLog([
            'module'      => 'province',
            'action'      => 'delete',
            'description' => $data->name
        ]);

        $result = $this->district->remove($id, false);
        ModelsDistrict::flushQueryCache(['districts']);

        return response()->json(
            [
                'status'  => 'success',
                'message' => message_module($this->module, 'crud.destroy_success'),
                'result'  => $result,
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
        $district = $this->district->query()->whereNull('deleted_at');

        return Datatables::of($district)
            ->editColumn('provinces', function ($district) {
                $provinces = DB::table('provinces')
                    ->where('id', $district->province_id)
                    ->whereNull('deleted_at')
                    ->first();

                return $provinces->name;
            })
            ->filterColumn('provinces', function(Builder $query ,$keyword) {
                $query->whereHas('province', function (Builder $query) use ($keyword) {
                    $query->where('provinces.name','like', "%{$keyword}%");
                });
            })
            ->editColumn('status', function ($language) {
                if ($language->status == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';

                }
                return $xhtml;
            })
            ->addColumn('actions', 'administrator.modules.district.actions')
            ->rawColumns(['status', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }
}
