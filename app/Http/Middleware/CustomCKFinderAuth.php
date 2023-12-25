<?php

namespace App\Http\Middleware;

use Closure;

class CustomCKFinderAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->level == 1) {

            if(env('Multi_Folder_Finder') == 'ON'){
                    if(auth()->user()->level == 1){
                        $file = 'uploads';
                    }else{
                        $file = auth()->user()->users_name;
                    }
                    
                    config([
                        'ckfinder.authentication' => function () use ($request) {
                            return true;
                        },
                        'ckfinder.backends.default' => array(
                            'name' => 'default',
                            'adapter' => 'local',
                            'baseUrl' => config('app.url') . '/'.$file.'/',
                            'root' => public_path('/'.$file.'/'),
                            'chmodFiles' => 0777,
                            'chmodFolders' => 0755,
                            'filesystemEncoding' => 'UTF-8',
                        )
                    ]);
            }else{
                config(['ckfinder.authentication' => function () use ($request) {
                    return true;
                }]);    
            }
        } else {
            config(['ckfinder.authentication' => function () use ($request) {
                return false;
            }]);
        }

        return $next($request);
    }
}
