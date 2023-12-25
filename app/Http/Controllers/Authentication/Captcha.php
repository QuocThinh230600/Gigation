<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;

class Captcha extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __invoke()
    {
        return captcha_img();
    }
}
