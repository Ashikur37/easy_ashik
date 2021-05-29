<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(){       
        return view('purchase.verify');
    }
    public function verify(Request $request){

        $url="https://takwasoft.com/api/verify?purchase_code=".$request->purchase_code;
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        if (!curl_exec($curl)) {
            return redirect()->back()->with('error','Unable to connect server.Please check data connection.');
        }
        curl_close($curl);
        if(json_decode($resp)->error==true){
            return redirect()->back()->with('error','Invalid purchase code');
        }
        else{
            $purchasedFile = storage_path('purchased');
            file_put_contents($purchasedFile, $request->purchase_code);
            return redirect('/install');
        }
    }

}