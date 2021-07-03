<?php

namespace App\Http\Controllers\Api;

use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Services\Notification;
use App\Model\Setting;
use App\Model\UserAddress;
use App\Model\UserOtp;
use App\Http\Resources\ProductCollection;
use App\Model\Product;
use App\Model\WishList;
use App\Services\MailService;

class UserController extends Controller
{
    /**
     * Register
     */
    public function register(Request $request)
    {
        if (User::where('email', $request->email)->first()) {
            $response = [
                'success' => false,
                'message' => "Mobile number already registered",
            ];
            return response()->json($response);
        }
        $otp = UserOtp::where('mobile_number', $request->mobile)->where('otp', $request->otp)->first();
        if (!$otp) {
            $response = [
                'success' => false,
                'message' => "Invalid otp",
            ];
            return response()->json($response);
        }
        try {
            $user = User::create([
                'name' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->mobile,
                'password' => Hash::make($request->password),
                'affiliate_link' => md5($request->mobile),
                'affiliate_balance' => 0
            ]);
            Notification::newUser($user->id);
            $setting = Setting::first();
            if ($setting->email_verification) {
                $user->sendEmailVerificationNotification();
            }


            $success = true;
            $message = 'User register successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function registerOtp(Request $request)
    {

        if (User::where('email', $request->mobile)->first()) {
            $response = [
                'success' => false,
                'message' => "Mobile number already registered",
            ];
            return response()->json($response);
        }
        $otp = rand(1000, 9999);
        UserOtp::updateOrCreate([
            'mobile_number' => $request->mobile,

        ], [
            'otp' => $otp
        ]);
        $text = "Your otp is " . $otp;
        $number = $request->mobile;

        $data =  MailService::singleSms($number, $text, uniqid());
        $response = [
            'success' => true,
            'message' => "OTP Sent successfully",
        ];
        return response()->json($response);
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->old_password, Auth::user()->password))) {
            return [
                "success" => false,
                "msg" => "Wrong old password"
            ];
        }
        $user = Auth::User();
        $user->password = Hash::make($request['password']);
        $user->save();
        return [
            "success" => true,
            "msg" => "Password updated successfully"
        ];
    }
    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = 'User login successfully';
            return [
                "user" => Auth::user(),
                "success" => true,
                "token" => Auth::user()->createToken('MyApp')->plainTextToken
            ];
        } else {
            $success = false;
            $message = 'Unauthorised';
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function createAddress(Request $request)
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
        return [
            "success" => true,
            "address" => $address,

        ];
    }
    public function uploadImage(Request $request)
    {
        $realImage = base64_decode($request->image);
        $imageName = rand(1, 99) . time() . '.png';
        auth()->user()->update([
            "provider" => "Easy",
            "avatar" => $imageName
        ]);
        file_put_contents(public_path() . "/images/user/" . $imageName, $realImage);
        return [
            "success" => true,
            "msg" => "Profile image updated successfully"
        ];
    }
    public function updateBasic(Request $request)
    {
        $user = Auth::user();
        $user->update([
            "name" => $request->first_name,
            "lastname" => $request->last_name,

        ]);
        return [
            "success" => true,
            "msg" => "Profile updated successfully",
            "user" => $user
        ];
    }
    public function getAddress()
    {
        $addresses = UserAddress::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return [
            "data" => $addresses
        ];
    }
    public function getSingleAddress(UserAddress $userAddress)
    {
        return $userAddress;
    }

    public function wishListProduct()
    {
        $productIds = WishList::where('user_id', auth()->user()->id)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)->paginate(10);
        return new ProductCollection($products);
    }
    public function addWishListProduct($id)
    {
        $wishlist = WishList::where('product_id', $id)->where('user_id', auth()->user()->id)->first();
        if ($wishlist) {
            WishList::where('product_id', $id)->where('user_id', auth()->user()->id)->delete();
            Session::put('wishCount', WishList::where('user_id', auth()->user()->id)->count());
            Session::put('wishProducts', WishList::where('user_id', auth()->user()->id)->pluck('product_id')->toArray());
            return [
                "success" => false,
                "msg" => "Product removed from wishlist"
            ];
        } else {
            WishList::updateOrCreate([
                'user_id' => auth()->user()->id,
                'product_id' => $id
            ]);
            Session::put('wishCount', WishList::where('user_id', auth()->user()->id)->count());
            Session::put('wishProducts', WishList::where('user_id', auth()->user()->id)->pluck('product_id')->toArray());
            return [
                "success" => true,
                "msg" => "Product added to wishlist"
            ];
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
}
