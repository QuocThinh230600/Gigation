<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Role\StoreRequest;
use App\Http\Requests\Administrator\Role\UpdateRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends AdminController
{
    private $route = 'admin.role.';

    private $view = 'administrator.modules.role.';

    private $module = 'module.role';

    /**
     * RoleController constructor.
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:role_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:role_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role_destroy', ['only' => ['destroy']]);
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
        $data_role = array(
            'name'        => $request->name,
            'guard_name'  => 'web',
            'description' => $request->description,
            'status'      => $request->status ?? 'off'
        );

        $role = Role::create($data_role);

        foreach ($request->permission as $item) {
            $permissions = Permission::firstOrCreate(['name' => $item, 'guard_name' => 'web']);
            $role->givePermissionTo($permissions);
        }

        $result = Role::findByName($role->name)->permissions;

        Role::flushQueryCache(['roles']);

        LogActivityHelper::addToLog([
            'module'      => 'role',
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
    public function show($id)
    {
        $data['role']            = Role::findById($id);
        $data['permission_edit'] = Role::findById($id)->permissions->pluck('name')->toArray();

        return response()->json(
            [
                'status' => 'success',
                'result' => $data
            ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function edit($id)
    {
        $data['role']            = Role::findById($id);
        $data['permission_edit'] = Role::findById($id)->permissions->pluck('name')->toArray();
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
    public function update(UpdateRequest $request, $id)
    {
        $role = Role::findById($id);

        $data_role = array(
            'name'        => $request->name,
            'guard_name'  => 'web',
            'description' => $request->description,
            'status'      => $request->status ?? 'off'
        );

        $role->update($data_role);

        DB::table('role_has_permissions')->where('role_id', $id)->delete();

        foreach ($request->permission as $item) {
            $permissions = Permission::firstOrCreate(['name' => $item, 'guard_name' => 'web']);
            $role->givePermissionTo($permissions);
        }

        $result = Role::findByName($request->name)->permissions;

        Role::flushQueryCache(['roles']);

        LogActivityHelper::addToLog([
            'module'      => 'role',
            'action'      => 'edit',
            'description' => $request->name
        ]);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['role' => $id]),
                'result'   => $result
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function destroy($id)
    {
        $totalModelHasRole = DB::table('model_has_roles')->where('role_id', $id)->count();
        Role::flushQueryCache(['roles']);

        if ($totalModelHasRole > 0) {
            return response()->json(
                [
                    'status'  => 'warning',
                    'message' => message_module($this->module, 'role.role_have_model'),
                ], 200);
        } else {
            $data = Role::findById($id);

            LogActivityHelper::addToLog([
                'module'      => 'role',
                'action'      => 'delete',
                'description' => $data->name,
            ]);

            $result = Role::destroy($id);

            return response()->json(
                [
                    'status'  => 'success',
                    'message' => message_module($this->module, 'crud.destroy_success'),
                    'result'  => $result
                ], 200);
        }
    }

    /**
     * Process datatables ajax request.
     * @return string
     * @throws \Exception
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function dataTableIndex()
    {
        $role = DB::table('roles')
            ->select(['id', 'name', 'status', 'created_at'])
            ->orderBy('created_at', 'DESC');

        return Datatables::of($role)
            ->editColumn('created_at', function ($role) {
                return $role->created_at;
            })
            ->editColumn('status', function ($role) {
                if ($role->status == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';

                }
                return $xhtml;
            })
            ->addColumn('actions', 'administrator.modules.role.actions')
            ->rawColumns(['status', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }
}
