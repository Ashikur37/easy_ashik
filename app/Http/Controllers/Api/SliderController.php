<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignCollection;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\SliderCollection;
use App\Model\Campaign;
use App\Model\Slide;

class SliderController extends Controller
{

    public function index()
    {
        return new SliderCollection((Slide::where("status",1)->orderBy('updated_at','desc')->get()));
    }
   


}