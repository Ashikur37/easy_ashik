<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LanguageService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.index');
    }
    public function updateProfile(Request $request){
        $user = Auth::User();
        $user->update([
            'name'=>$request->name,
            'lastname'=>$request->lastname,
            'email'=>$request->email,

        ]);
        return redirect()->back()->with("success", LanguageService::getTranslate("AccountUpdatedSuccessfully"));
    }
    public function updatePassword(Request $request){
        $user = Auth::User();

        if($request->old_password){ 
            if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
                return redirect()->back()->with("error",LanguageService::getTranslate("YourCurrentPasswordDoesNotMatchesWithThePasswordYouProvided"));
            }
            if (strlen($request->password) < 6) {
                return redirect()->back()->with("error",LanguageService::getTranslate("LengthOfNewPasswordMustBeAtLeast6"));
            }
            if ($request->password != $request->password_confirmation) {
                return redirect()->back()->with("error",LanguageService::getTranslate("PasswordDoesn'tMatch"));
            }
            $user->password = Hash::make($request['password']);
        }
        $user->save();
        return redirect()->back()->with("success", LanguageService::getTranslate("AccountUpdatedSuccessfully"));
    }

}