<?php

namespace Pranto\MultiLanguage\Controllers;
use App\Http\Controllers\Controller;
use Pranto\MultiLanguage\Models\Language;

class FrontendController extends Controller
{
     public function __construct()
    {
        $this->middleware('web');
    }
   public function changeLang($lang)
   {
        $language = Language::where('code', $lang)->first();


        if (!$language) $lang = 'en';
        session()->put('lang', $lang);

        return $lang;

        return redirect()->back();
    }

}
