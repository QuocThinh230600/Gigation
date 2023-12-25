<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    /**
     * Redirect the user to the provider authentication page.
     *
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @param $provider
     * @return mixed
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $user = User::firstOrCreate(
            [
                'email'    => $user->email,
                'provider' => $provider,
            ],
            [
                'full_name'   => $user->name,
                'password'    => bcrypt(Str::random(24)),
                'level'       => 2,
                'avatar'      => $user->avatar,
                'status'      => 'on',
                'provider'    => $provider,
                'provider_id' => $user->id
            ]
        );

        Auth::login($user);

        return redirect()->route('index');
    }
}
