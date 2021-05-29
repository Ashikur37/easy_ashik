<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\PaymentSetting;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Cache;
class PaymentSettingController extends Controller
{
    public function general(){
        $paymentSetting=PaymentSetting::first();
        return view('admin.setting.payment.general',compact('paymentSetting'));
    }
    public function updateGeneral(Request $request){
        $paymentSetting=PaymentSetting::first();
        $paymentSetting->update([
            'is_cod'=>$request->is_cod?1:0,
            'tax'=>$request->tax
        ]);
        return back()->with('success',LanguageService::getTranslate('PaymentSettingUpdatedSuccessfully'));
    }
    public function paypal(){
        $paymentSetting=PaymentSetting::first();
        return view('admin.setting.payment.paypal',compact('paymentSetting'));
    }
    public function updatePaypal(Request $request){
        $paymentSetting=PaymentSetting::first();
        $paymentSetting->update([
            'is_paypal'=>$request->is_paypal?1:0,
            'paypal_mode'=>$request->paypal_mode,
            'paypal_client'=>$request->paypal_client,
            'paypal_secret'=>$request->paypal_secret,

        ]);
        Cache::put('paymentSetting',PaymentSetting::first());
        return back()->with('success',LanguageService::getTranslate('PaypalSettingUpdatedSuccessfully')); 
    }
    public function stripe(){
        $paymentSetting=PaymentSetting::first();
        return view('admin.setting.payment.stripe',compact('paymentSetting'));
    }
    public function updateStripe(Request $request){
        $paymentSetting=PaymentSetting::first();
        $paymentSetting->update([
            'is_stripe'=>$request->is_stripe?1:0,
            'stripe_key'=>$request->stripe_key,
            'stripe_secret'=>$request->stripe_secret,
        ]);
        Cache::put('paymentSetting',PaymentSetting::first());
        return back()->with('success',LanguageService::getTranslate('StripeSettingUpdatedSuccessfully'));
    }
    public function sslCommerz(){
        $paymentSetting=PaymentSetting::first();
        return view('admin.setting.payment.ssl',compact('paymentSetting'));

    }
    public function updateSslCommerz(Request $request){
        $paymentSetting=PaymentSetting::first();
        $paymentSetting->update([
            'is_ssl'=>$request->is_ssl?1:0,
            'store_id'=>$request->store_id,
            'store_password'=>$request->store_password,
            'ssl_mode'=>$request->ssl_mode,

        ]);
        Cache::put('paymentSetting',PaymentSetting::first());
        return back()->with('success',"SSL Commerz updated"); 
    }
    public function razorpay(){
        $paymentSetting=PaymentSetting::first();
        return view('admin.setting.payment.razorpay',compact('paymentSetting'));
    }
    public function updateRazorpay(Request $request){
        $paymentSetting=PaymentSetting::first();
        $paymentSetting->update([
            'is_razor_pay'=>$request->is_razor_pay?1:0,
            'razorpay_key'=>$request->razorpay_key,
            'razorpay_secret'=>$request->razorpay_secret,
        ]);
        Cache::put('paymentSetting',PaymentSetting::first());
        return back()->with('success',LanguageService::getTranslate('RazorpaySettingUpdatedSuccessfully'));
    }
}