<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Personal\UpdateAccountRequest;
use App\Repositories\LoginHistory\LoginHistoryRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PersonalController extends AdminController
{
    private $route = 'admin.personal.';

    private $view = 'administrator.modules.personal.';

    private $module = 'module.personal';

    private $user;

    private $loginHistory;

    /**
     * PersonalController constructor.
     * @param UserRepository $user
     * @param LoginHistoryRepository $loginHistory
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(UserRepository $user, LoginHistoryRepository $loginHistory)
    {
        parent::__construct();
        $this->user         = $user;
        $this->loginHistory = $loginHistory;
    }

    /**
     * Display a personal account
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function show()
    {
        $uuid         = auth()->user()->uuid;
        $data['user'] = $this->user->getByUuid($uuid);
        return view($this->view . 'index', $data);
    }

    /**
     * Update account login
     * @param UpdateAccountRequest $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update_account(UpdateAccountRequest $request)
    {
        $user           = auth()->user();
        $user->password = bcrypt($request->password);
        $user->save();

        LogActivityHelper::addToLog([
            'module'      => 'personal',
            'action'      => 'edit',
            'description' => auth()->user()->email,
        ]);

        return response()->json([
            'status'   => 'success',
            'message'  => message_module($this->module, 'crud.edit_success'),
            'redirect' => route($this->route . 'logout'),
        ]);
    }

    /**
     * Update account information
     * @param Request $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update_info(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        $uuid = auth()->user()->uuid;

        $this->user->update($data, $uuid);

        LogActivityHelper::addToLog([
            'module'      => 'personal',
            'action'      => 'edit',
            'description' => auth()->user()->email,
        ]);

        return response()->json([
            'status'   => 'success',
            'message'  => message_module($this->module, 'crud.edit_success'),
            'redirect' => route($this->route . 'show'),
        ]);
    }

    /**
     * Update account only avatar
     * @param Request $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update_avatar(Request $request)
    {
        $ext_img = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'];;

        if (!checkExt($request->avatar, $ext_img)) {
            return response()->json([
                'status'   => 'warning',
                'message'  => message('personal.file_ext_wrong'),
                'redirect' => route($this->route . 'show'),
            ]);
        }

        $uuid = auth()->user()->uuid;

        $this->user->update([
            'avatar' => $request->avatar,
        ], $uuid);

        LogActivityHelper::addToLog([
            'module'      => 'personal',
            'action'      => 'edit',
            'description' => auth()->user()->email,
        ]);

        return response()->json([
            'status'   => 'success',
            'message'  => message_module($this->module, 'crud.edit_success'),
            'redirect' => route($this->route . 'show'),
        ]);
    }

    /**
     * Sign out of your account
     * @param Request $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        foreach ($user->tokens as $token) {
            $token->revoke();
        }

        auth()->logout();

        return redirect()->route('auth.showLoginForm');
    }

    public function dataTableIndex()
    {
        $user_uuid = auth()->user()->uuid;

        $user = $this->loginHistory->getHistoryByUser($user_uuid);

        return Datatables::of($user)
            ->editColumn('login_at', function ($user) {
                return $user->login_at->format('d/m/Y - H:i:s');
            })
            ->addIndexColumn()
            ->make(true);
    }
}
