<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Model\Campaign;
use App\Model\FlashSale;
use App\Model\Shop;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Collection;

class OfferController extends Controller
{
    public function singleVoucher()
    {
        return view('front/single-voucher');
    }

    public function rocketShop()
    {
        return view('front/rocketshop');
    }

    public function campaigns()
    {

        $offers = FlashSale::where('is_active', 1)->where('end', '>=', today())->get();
        return view('front/campaigns', compact('offers'));
    }

    public function campaignList()
    {
        $campaigns = Campaign::where('is_active', 1)->get();
        return view('front/campaign-list', compact('campaigns'));
    }

    public function shops()
    {
        $shops = Shop::all();

        return view('front/shop', compact('shops'));
    }

    public function singleCampaign($title)
    {
        $campaign = Campaign::where('title', $title)->first();
        $products = $campaign->campaignProducts;

        $view = "grid";
        $cartProducts = [];
        $items = Cart::content();
        foreach ($items as $item) {
            $cartProducts[$item->id] = [
                "qty" => $item->qty,
                "rowId" => $item->rowId,
            ];
        }
        $products = (new Collection($products))->paginate(12);
        return view('front/single-campaign', compact('view', 'products', 'cartProducts'));
    }
}
