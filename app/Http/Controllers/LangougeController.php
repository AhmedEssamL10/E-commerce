<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LangougeController extends Controller
{
    //
    public function en()
    {
        App::setLocale('en');
        //store in session
        Session::put('lang', 'en');
        return back();
    }
    public function ar()
    {
        App::setLocale('ar');
        //store in session
        Session::put('lang', 'ar');
        return back();
    }
}
