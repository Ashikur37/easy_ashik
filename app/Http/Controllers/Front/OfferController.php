<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function singleVoucher(){
        return view('Front/single-voucher');
    }

    public function rocketShop(){
        return view('Front/rocketshop');
    }

    public function campaigns(){
        return view('Front/campaigns');
    }

    public function singleCampaign(){
        return view('Front/single-campaign');
    }
}
