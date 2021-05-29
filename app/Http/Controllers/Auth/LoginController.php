<?php
namespace App\Http\Controllers\Auth;

use App\User;
use Exception;
use App\Http\Controllers\Controller;
use App\Model\Setting;
use App\Model\SocialLoginSetting;
use App\Services\Notification;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

use Session;

class LoginController extends Controller
{

    public function __construct()
    { 

        //$this->middleware('guest');
        // $link = Socialsetting::findOrFail(1);
        $socialSetting=SocialLoginSetting::first();
        Config::set('services.google.client_id', $socialSetting->google_client_id);
        Config::set('services.google.client_secret', $socialSetting->google_client_secret);
        Config::set('services.facebook.client_id', $socialSetting->facebook_client_id);
        Config::set('services.facebook.client_secret', $socialSetting->facebook_client_secret);
        Config::set('services.google.redirect', url('/oauth/google/callback'));
        $url = url('/oauth/facebook/callback');
        $url = preg_replace("/^http:/i", "https:", $url);
        Config::set('services.facebook.redirect', $url);
    }

    protected $providers = [
        'github','facebook','google','twitter'
    ];

    public function showLoginForm()
    {
        $socialSetting=SocialLoginSetting::first();
        return view('auth.login',compact('socialSetting'));
    }

    public function resetMobile(Request $request){
        $user=User::whereEmail($request->email)->first();
        if(!$user){
            return back()->with('error','Mobile number not found');
        }
        else{
            $rand=rand(1000,9999);
            Session::put('reset_code',$rand);
            Session::put('reset_email',$request->email);
            //send sms
            $text = "Dear ".$user->name." enter your otp is ".$rand;

            // $smsresult = file_get_contents("http://66.45.237.70/api.php?username=01531173930&password=5X6HC8M3&number=$request->email&message=$text");
            
            $url = "http://66.45.237.70/api.php";
            $number=$request->email;
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
            //redirect
            
            return redirect('/reset/password/mobile');
        }

    }
    public function showMobileReset(){
        return view('auth.passwords.confirm_mobile');

    }
    public function updatePasswordMobile(Request $request){
        $request->validate([
            'code'=>['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if($request->code!=Session::get('reset_code')){
            return back()->with('error','Invalid otp code');
        }
        $user=User::whereEmail(Session::get('reset_email'))->first();
            $user->update([
                "password"=>Hash::make($request->password)
            ]);
            return redirect('/')->with('success','Your password has been reseted successfully');

    }

    public function redirectToProvider($driver)
    {
        
        if( ! $this->isProviderAllowed($driver) ) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

  
    public function handleProviderCallback( $driver )
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty( $user->email )
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function sendSuccessResponse()
    {

         if(auth()->user()->type==3){
                    return redirect('/admin');
                }
                else if(auth()->user()->type==0){
                    return redirect()->route('user.home');
                }
                else{
                    
                }
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('social.login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    public function login(Request $request)
    {
         $setting = Setting::first();
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $remember=false;
        if($request->remember){
            $remember=true;
        }
        if (request()->ajax()) {
            if (Auth::attempt(array('email' => $request['email'], 'password' => $request['password']),$remember)) {
                return 1;
            } 
            return 0;
        }
        
        if (Auth::attempt(array('email' => $request['email'], 'password' => $request['password']),$remember)) {
                if(auth()->user()->type==3){
                    return redirect('/admin');
                }
                else if(auth()->user()->type==0){
                    if(!auth()->user()->email_verified_at&&$setting->email_verification&&!auth()->user()->provider){
                        auth()->user()->sendEmailVerificationNotification();
                        Auth::logout();
                        return redirect()->back()->with('error','Please verify your email');
                    }
                    return redirect()->route('user.home');
                }
                else{
                    
                }
        }
        else{
            return redirect()->back()->with([
                'error'=>'Invalid email or password',
                'old_email'=>$request['email']
            ]);
        }
    }
    protected function loginOrCreateAccount($providerUser, $driver) {

        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();
    
            // if user already found
            if( $user ) {
                // update the avatar and provider that might have changed
                $user->update([
                    'avatar' => $providerUser->avatar,
                    'provider' => $driver,
                    'provider_id' => $providerUser->id,
                    'access_token' => $providerUser->token,
                ]);
            } else {
                  if($providerUser->getEmail()){ //Check email exists or not. If exists create a new user
                   $user = User::create([
                      'name' => $providerUser->getName(),
                      'email' => $providerUser->getEmail(),
                      'avatar' => $providerUser->getAvatar(),
                      'provider' => $driver,
                      'provider_id' => $providerUser->getId(),
                      'access_token' => $providerUser->token,
                      'password' => '', // user can use reset password to create a password
                      'affiliate_link'=>md5($providerUser->getEmail()),
                      'email_verified_at'=>now(),
                ]);
                Notification::newUser($user->id);
    
                 }else{
                
                //Show message here what you want to show
                
               }
          }
    
          // login the user
            Auth::login($user, true);
            return $this->sendSuccessResponse();
      }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    public function signout(){
        Auth::logout();
        return redirect('/');
    }
    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}