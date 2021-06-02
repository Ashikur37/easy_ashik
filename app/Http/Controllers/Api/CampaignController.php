<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignCollection;
use App\Http\Resources\ProductCollection;
use App\Model\Campaign;


class CampaignController extends Controller
{

    public function index()
    {
        return new CampaignCollection(Campaign::where('is_active', 1)->get());
    }
    public function product(Campaign $campaign){
        
         return new ProductCollection($campaign->campaignProducts()->orderBy('id','desc')->paginate(10));
    }


}