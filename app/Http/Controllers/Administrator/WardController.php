<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Ward\StoreRequest;
use App\Http\Requests\Administrator\Ward\UpdateRequest;
use App\Http\Resources\Ward;
use App\Models\Ward as ModelsWard;
use App\Repositories\District\DistrictRepository;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\Ward\WardRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\DataTables;

class WardController extends AdminController
{
    private $view = 'administrator.modules.ward.';

    private $route = 'admin.ward.';

    private $module = 'module.ward';

    private $province;

    private $district;

    private $ward;

    /**
     * WardController constructor.
     * @param ProvinceRepository $province
     * @param DistrictRepository $district
     * @param WardRepository $ward
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ProvinceRepository $province,
                                DistrictRepository $district,
                                WardRepository $ward)
    {
        parent::__construct();
        $this->middleware('permission:ward_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:ward_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ward_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ward_destroy', ['only' => ['destroy']]);
        $this->province = $province;
        $this->district = $district;
        $this->ward     = $ward;
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
            $ward = $this->ward->getAll();
            return new Ward($ward);
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
        $data['provinces']  = $this->province->getAll();
        $provinces_first_id = $data["provinces"][0]->id;
        $data['districts']  = $this->district->getDistrictByProvince($provinces_first_id);
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
        $data             = $request->only('name', 'gso_id', 'district_id');
        $data['status']   = $request->status ?? 'off';
        $data['featured'] = $request->default ?? 'off';
        $result           = $this->ward->create($data);

        ModelsWard::flushQueryCache(['wards']);
        LogActivityHelper::addToLog([
            'module'      => 'ward',
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
        $result = $this->ward->getById($id);

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
        $data['provinces']   = $this->province->getAll();
        $data['ward']        = $this->ward->getById($id);
        $district_id         = $data['ward']->district_id;
        $provinceByDistrict  = $this->district->getProvinceByDistrict($district_id);
        $data['province_id'] = $provinceByDistrict->province_id;
        $data['district']    = $this->district->getDistrictByProvince($data['province_id']);

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
        $data             = $request->only('name', 'gso_id', 'district_id');
        $data['status']   = $request->status ?? 'off';
        $data['featured'] = $request->featured ?? 'off';
        $result           = $this->ward->update($data, $id, false);

        ModelsWard::flushQueryCache(['wards']);

        LogActivityHelper::addToLog([
            'module'      => 'ward',
            'action'      => 'edit',
            'description' => $request->name
        ]);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['ward' => $id]),
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
        $data = $this->ward->getById($id);

        LogActivityHelper::addToLog([
            'module'      => 'ward',
            'action'      => 'delete',
            'description' => $data->name
        ]);

        $result = $this->ward->remove($id, false);
        ModelsWard::flushQueryCache(['wards']);

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
        $ward = DB::table('wards')
                ->select('provinces.name as pname', 'districts.name as dname', 'wards.name as wname', 'wards.status as wstatus', 'wards.id as wid')
                ->join('districts', 'districts.id', '=', 'wards.district_id')
                ->join('provinces', 'provinces.id', '=', 'districts.province_id')
                ->whereNull('wards.deleted_at');

        return Datatables::of($ward)
            ->editColumn('wstatus', function ($ward) {
                if ($ward->wstatus == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';
                }
                return $xhtml;
            })
            ->addColumn('actions', 'administrator.modules.ward.actions')
            ->rawColumns(['wstatus', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Load district by province
     * @param \Illuminate\Http\Request $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function loadDistrict(\Illuminate\Http\Request $request)
    {
        $district = $this->district->getDistrictByProvince($request->id);

        return response()->json($district);
    }
}
