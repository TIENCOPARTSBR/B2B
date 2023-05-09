<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App;

class LanguageController extends Controller
{
    public function index() 
    {
        return view('/');
    }

    public function changeLang( $langcode )
    {
        App::setLocale($langcode);
        session()->put("lang_code", $langcode);
        return redirect()->back();
    }
}
