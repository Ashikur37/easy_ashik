<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{

     public function paycancle(){
         return redirect()->back()->with('error','Payment Cancelled.');
     }

     public function payreturn(){
 
         return view('front.success',compact('tempcart','order'));
     }






}
