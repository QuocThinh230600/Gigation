<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use App\Models\LogActivity;

class LogActivityHelper
{

    public static function addToLog($content)
    {
        $data['module']      = $content["module"];
        $data['action']      = $content["action"];
        $data['description'] = $content["description"] ?? null;
        $data['url']         = Request::fullUrl();
        $data['method']      = Request::method();
        $data['ip']          = Request::ip();
        $data['agent']       = Request::header('user-agent');
        $data['user_id']     = auth()->check() ? auth()->user()->id : 1;

        LogActivity::where('created_at', '<=', Carbon::now()->subMonth()->toDateTimeString())->delete();

        LogActivity::create($data);
    }


    public static function logActivityLists()
    {
        return LogActivity::latest()->get();
    }
}