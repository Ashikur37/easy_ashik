<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Model\FlashSale;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function singleVoucher()
    {
        return view('Front/single-voucher');
    }

    public function rocketShop()
    {
        return view('Front/rocketshop');
    }

    public function campaigns()
    {

        $offers = FlashSale::where('is_active', 1)->where('end', '>=', today())->get();
        return view('Front/campaigns', compact('offers'));
    }

    public function singleCampaign()
    {
        return view('Front/single-campaign');
    }
}
