<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    function getCaptcha(){
        return captcha_img();
    }
}
