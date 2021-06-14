<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{

    public function changePassword()
    {
        return view('user.profile.change-password');
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::User();

        if ($request->old_password) {
            if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
                return redirect()->back()->with("error", LanguageService::getTranslate("YourCurrentPasswordDoesNotMatchesWithThePasswordYouProvided"));
            }
            if (strlen($request->password) < 6) {
                return redirect()->back()->with("error", LanguageService::getTranslate("LengthOfNewPasswordMustBeAtLeast6"));
            }
            if ($request->password != $request->password_confirmation) {
                return redirect()->back()->with("error", LanguageService::getTranslate("PasswordDoesn'tMatch"));
            }
            $user->password = Hash::make($request['password']);
        }
        $user->save();
        return redirect()->back()->with("success", LanguageService::getTranslate("AccountUpdatedSuccessfully"));
    }

    public function changeProfile()
    {
        return view('user.profile.change-profile');
    }
    public function updateProfile(Request $request)
    {

        if ($request->image) {
            $imageName = $request->image;
            auth()->user()->update([
                "provider" => "Easy",
                "avatar" => $imageName
            ]);
            unset($request->image);
        }

        auth()->user()->update($request->all());
        return redirect()->back()->with("success", LanguageService::getTranslate("AccountUpdatedSuccessfully"));
    }
}
