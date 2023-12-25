<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Verify extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $token
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __invoke($token)
    {
        $user_check = User::where('token', $token)->where('email_verified_at', '>=', Carbon::now())->exists();

        if ($user_check) {
            User::where('token', $token)->firstOrFail()->update(
                [
                    'token'  => null,
                    'status' => 'on'
                ]
            );

            if (Request::is('api*')) {
                return response()->json([
                    'message' => message('verify.success')
                ], 200);
            }

            return redirect()->route('auth.showLoginForm')->with('success', message('verify.success'));
        } else {
            User::where('token', $token)->forceDelete();

            if (Request::is('api*')) {
                return response()->json([
                    'message' => message('verify.timeout')
                ], 404);
            }

            return redirect()->route('auth.showRegisterForm')->with('error', message('verify.timeout'));
        }
    }
}
