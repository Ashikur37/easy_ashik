<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Services\LanguageService;

class SettingController extends Controller
{
    public function cookieBar(){
        return view('admin.setting.other.cookie');
    }
    public function cookieBarUpdate(Request $request){

        return back()->with('success',LanguageService::getTranslate('CookiebarUpdatedSuccessfully'));
    }

}
