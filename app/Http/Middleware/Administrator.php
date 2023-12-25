<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function handle($request, Closure $next, $roles)
    {
        if (auth()->check() && auth()->user()->level == $roles) {
            return $next($request);
        } else {
            return redirect()->route('auth.showLoginForm')->with('error', message('login.check'));
        }

    }
}
