<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\UserAddress;
use App\Model\Withdraw;
use App\Services\LanguageService;
use App\Services\Notification;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $addresses = UserAddress::where('user_id', $user->id)->all();
        return view('user.address.index', compact('addresses'));
    }
    public function create()
    {
        return view('user.address.create');
    }
    public function store(Request $request)
    {
        $user = Auth::user();

        $address = UserAddress::create([
            "user_id" => $user->id,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "mobile" => $request->mobile,
            "city" => $request->city,
            "email" => $request->email,
            "zip" => $request->zip,
            "street_address" => $request->street_address,
            "region" => $request->region,
        ]);
        return redirect('/user/user-address');
    }
    public function deleteAddress(UserAddress $userAddress)
    {
        if ($userAddress->user_id == auth()->id()) {
            $userAddress->delete();
        }
        return back()->with('success', 'Address Deleted');
    }

    public function loadAddress(UserAddress $userAddress)
    {
        return view('load.user.address', compact('userAddress'));
    }
}
