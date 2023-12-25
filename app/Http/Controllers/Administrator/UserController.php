<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\User\StoreRequest;
use App\Http\Requests\Administrator\User\UpdateRequest;
use App\Http\Resources\User;
use App\Models\User as ModelsUser;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends AdminController
{
    private $view = 'administrator.modules.user.';

    private $route = 'admin.user.';

    private $module = 'module.user';

    private $user;

    /**
     * UserController constructor.
     * @param UserRepository $user
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(UserRepository $user)
    {
        parent::__construct();
        $this->middleware('permission:user_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:user_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user_destroy', ['only' => ['destroy']]);
        $this->user = $user;
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
            $users = $this->user->getAll();
            return new User($users);
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
        $data['roles'] = Role::select('id', 'name')->where('status', 'on')->get();

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
        $data             = $request->except(['_token', '_method', 'role_id', 'password_confirmation']);
        $data['password'] = bcrypt($request->password);
        $data['status']   = $request->status ?? 'off';

        $result = $this->user->create($data);

        if ($request->level == 1) {
            $result->assignRole($request->role_id);
        }

        ModelsUser::flushQueryCache(['users']);
        LogActivityHelper::addToLog([
            'module'      => 'user',
            'action'      => 'create',
            'description' => $request->email
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
        $data['user']              = $this->user->getByUuid($uuid);
        $data['roles']             = Role::where('status', 'on')->get();
        $data['pemission_current'] = DB::table('model_has_roles')->where('model_id', $data['user']->id)->value('role_id');

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
     * @return  mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function edit(string $uuid)
    {
        $data['user']              = $this->user->getByUuid($uuid);
        $data['roles']             = Role::where('status', 'on')->get();
        $data['pemission_current'] = DB::table('model_has_roles')->where('model_id', $data['user']->id)->value('role_id');

        if ((auth()->user()->id != 1) && ($data['user']->id == 1 || ($data['user']->level == 1 && (auth()->user()->id != $data['user']->id)))) {
            return redirect()->route($this->route . 'index')->with('warning', trans('message.user.cant_delete'));
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
        $data           = $request->except(['_token', '_method', 'email', 'password_confirmation', 'role_id']);
        $data['status'] = $request->status ?? 'off';
        $user           = $this->user->getByUuid($uuid);

        if ((auth()->user()->id != 1) && ($user['user']->id == 1 || ($user['user']->level == 1 && (auth()->user()->id != $user['user']->id)))) {
            return redirect()->route($this->route . 'index')->with('warning', trans('message.user.cant_delete'));
        }

        if (empty($request->password)) {
            $data['password'] = $user->password;
        } else {
            $request->validate(
                [
                    'password' => ['bail', 'required', 'min:6', 'confirmed']
                ], [],
                [
                    'password' => attr('user.password'),
                ]
            );

            $data['password'] = bcrypt($request->password);
        }

        $result = $this->user->update($data, $uuid);

        $user_role = $this->user->getByUuid($uuid);

        DB::table('model_has_roles')->where('model_id', $user_role->id)->delete();

        if ($request->level == 1) {
            $result->assignRole($request->role_id);
        }

        ModelsUser::flushQueryCache(['users']);

        LogActivityHelper::addToLog([
            'module'      => 'user',
            'action'      => 'edit',
            'description' => $request->email
        ]);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['user' => $uuid]),
                'result'   => $result
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
        $user = $this->user->getByUuid($uuid);

        if (($user->id == 1) || (auth()->user()->id != 1 && $user->level == 1)) {
            return response()->json(
                [
                    'status'   => 'warning',
                    'message'  => trans('message.user.cant_delete'),
                    'redirect' => route($this->route . 'index'),
                ]);
        }

        LogActivityHelper::addToLog([
            'module'      => 'user',
            'action'      => 'delete',
            'description' => $user->email
        ]);

        $result = $this->user->remove($uuid);

        ModelsUser::flushQueryCache(['users']);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.destroy_success'),
                'redirect' => route($this->route . 'index'),
                'result'   => $result
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
        $user = $this->user->query();

        return Datatables::of($user)
            ->blacklist(['password'])
            ->editColumn('avatar', function ($user) {
                if ($user->avatar == NULL) {
                    return '<img class="rounded-circle mr-2" height="34" width="34" src="' . asset(GLOBAL_ASSETS_IMG . 'avatar.svg') . '">';
                } else {
                    return '<img class="rounded-circle mr-2" height="34" width="34" src="' . $user->avatar . '">';
                }
            })
            ->editColumn('level', function ($user) {
                if ($user->level == 1) {
                    return label('user.admin');
                } else {
                    return label('user.member');
                }
            })
            ->editColumn('status', function ($user) {
                if ($user->status == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';
                }
                return $xhtml;
            })
            ->addColumn('actions', 'administrator.modules.user.actions')
            ->rawColumns(['avatar', 'status', 'actions'])
            ->make(true);
    }
}
