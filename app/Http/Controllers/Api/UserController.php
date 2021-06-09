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

class UserController extends Controller
{
    /**
     * Register
     */
    public function register(Request $request)
    {
        if(User::where('email',$request->email)->first()){
            $response = [
                'success' =>false,
                'message' => "Mobile number already registered",
            ];
            return response()->json($response);
        }
        $otp=UserOtp::where('mobile_number',$request->mobile)->where('otp',$request->otp)->first();
        if(!$otp){
            $response = [
                'success' =>false,
                'message' => "Invalid otp",
            ];
            return response()->json($response);
        }
        try {
            $user= User::create([
                'name' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->mobile,
                'password' => Hash::make($request->password),
                'affiliate_link'=>md5($request->mobile),
                'affiliate_balance'=>0
            ]);
            Notification::newUser($user->id);
            $setting=Setting::first();
            if($setting->email_verification){
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

    public function registerOtp(Request $request){

        if(User::where('email',$request->mobile)->first()){
            $response = [
                'success' =>false,
                'message' => "Mobile number already registered",
            ];
            return response()->json($response);
        }
        $otp=rand(1000,9999);
        UserOtp::updateOrCreate([
            'mobile_number'=>$request->mobile,
            
        ],[
            'otp'=>$otp
        ]);
        $text = "Your otp is ".$otp;

        // $smsresult = file_get_contents("http://66.45.237.70/api.php?username=01531173930&password=5X6HC8M3&number=$request->email&message=$text");
        
        $url = "http://66.45.237.70/api.php";
        $number=$request->mobile;
        // $text="Hello Bangladesh";
        $data= array(
        'username'=>"01531173930",
        'password'=>"5X6HC8M3",
        'number'=>"$number",
        'message'=>"$text"
        );
        
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $response = [
            'success' =>true,
            'message' => "OTP Sent successfully",
        ];
        return response()->json($response);
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
                "user"=>Auth::user(),
                "success"=>true,
                "token"=>Auth::user()->createToken('MyApp')->plainTextToken
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

    public function createAddress(Request $request){
        $user=Auth::user();

        $address=UserAddress::create([
                "user_id"=>$user->id,
                "first_name"=>$request->first_name,
                "last_name"=>$request->last_name,
                "mobile"=>$request->mobile,
                "city"=>$request->city,
                "email"=>$request->email,
                "zip"=>$request->zip,
                "street_address"=>$request->street_address,
                "region"=>$request->region,
        ]);
        return [
            "success"=>true,
            "address"=>$address
        ];
    }

    public function getAddress(){
        $addresses= UserAddress::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return [
            "data"=>$addresses
        ];
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