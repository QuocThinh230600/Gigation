<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        foreach ($user->tokens as $token) {
            $token->revoke();
        }

        Auth::logout();

        return response()->json([
            'status'   => 'success',
            'message'  => message('logout.success'),
            'redirect' => route('auth.showLoginForm')
        ], 200);
    }
}
