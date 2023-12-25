<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\ChangePassRequest;
use App\Http\Requests\Authentication\ForgotRequest;
use App\Models\PasswordResets;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class ForgotController extends Controller
{
    private $view = 'authentication.pages.';

    /**
     * Display for entering the account to retrieve the password
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function showForgotForm()
    {
        return view($this->view . 'forgot');
    }

    /**
     * The process of forgotten passwords
     * @param ForgotRequest $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function forgot(ForgotRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            return response()->json([
                'success'  => 'warning',
                'message'  => trans('passwords.user'),
                'redirect' => route('auth.showForgotForm')
            ], 401);
        }

        $passwordReset = PasswordResets::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60)
        ]);

        // $user->sendForgotPasswordEmail($passwordReset->token);

        return response()->json([
            'status'   => 'success',
            'message'  => trans('passwords.changpassword'),
            'redirect' => route('auth.showChangePasswordForm', ['token' => $passwordReset->token])
        ], 200);
    }

    /**
     * Show password change template
     * @param string $token
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function showChangePasswordForm(string $token)
    {
        $passwordReset = PasswordResets::where('token', $token)->firstOrFail();

        if (Carbon::parse($passwordReset->created_at)->addMinutes(15)->isPast()) {

            $passwordReset->delete();

            if (Request::is('api*')) {
                return response()->json([
                    'status'   => 'warning',
                    'message'  => trans('passwords.token'),
                    'redirect' => route('auth.showForgotForm')
                ], 422);
            }

            return redirect()->route('auth.showForgotForm')->with('warning', trans('passwords.token'));
        } else {
            if (Request::is('api*')) {
                return response()->json(['token' => $token], 200);
            }
            return view('authentication.pages.change_pass', ['token' => $token]);
        }
    }

    /**
     * Processing password changes
     * @param ChangePassRequest $request
     * @param string $token
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function changePassword(ChangePassRequest $request, string $token)
    {
        $passwordReset = PasswordResets::where('token', $token)->firstOrFail();
        $user          = User::where('email', $passwordReset->email)->firstOrFail();

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(15)->isPast()) {
            $passwordReset->delete();

            return response()->json(
                [
                    'status'   => 'warning',
                    'message'  => trans('passwords.token'),
                    'redirect' => route('auth.showForgotForm')
                ], 401);
        } else {
            $data['password'] = bcrypt($request->password);
            $user->update($data);
            $passwordReset->delete();

            return response()->json([
                'status'   => 'success',
                'message'  => trans('passwords.reset'),
                'redirect' => route('auth.login')
            ], 200);
        }
    }
}
