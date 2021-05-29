<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\SocialLoginSetting;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Lang;

class SocialLoginController extends Controller
{
    public function socialLogin(){
        $socialSetting=SocialLoginSetting::first();
        return view('admin.setting.social.login',compact('socialSetting'));
    }
    public function updateSocialLogin(Request $request){
        $socialSetting=SocialLoginSetting::first();
        $socialSetting->update([
            'is_facebook'=>$request->is_facebook?1:0,
            'facebook_client_id'=>$request->facebook_client_id,
            'facebook_client_secret'=>$request->facebook_client_secret,
            'is_google'=>$request->is_google?1:0,
            'google_client_id'=>$request->google_client_id,
            'google_client_secret'=>$request->google_client_secret,
        ]);
        return back()->with('success',LanguageService::getTranslate('FacebookLoginUpdatedSuccessfully'));
    }

}