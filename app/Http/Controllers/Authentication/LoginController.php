<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $view = 'authentication.pages.';

    /**
     * Get the login username to be used by the controller.
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Show template form login
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function showLoginForm()
    {
        return view($this->view . 'login');
    }

    /**
     * Account login processing
     * @param LoginRequest $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function login(LoginRequest $request)
    {
        $remember = ($request->remember) ? true : false;

        $login = array(
            'email'    => $request->email,
            'password' => $request->password,
            'level'    => 1,
            'status'   => 'on'
        );

        if (Auth::attempt($login, $remember)) {
            $tokenResult = $request->user()->createToken('Personal Access Token');
            $token       = $tokenResult->token;
            $token->save();

            return response()->json([
                'status'       => 'success',
                'message'      => message('login.success'),
                'access_token' => $tokenResult->accessToken,
                'token_type'   => 'Bearer',
                'expires_at'   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
                'redirect'     => route('admin.dashboard')
            ], 200);
        } else {
            return response()->json([
                'status'  => 'fail',
                'message' => message('login.fail'),
            ], 401);
        }
    }
}
