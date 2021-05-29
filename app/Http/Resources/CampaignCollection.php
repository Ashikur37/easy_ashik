<?php

namespace App\Http\Resources;

use App\Model\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Utility\CategoryUtility;
use Illuminate\Support\Facades\URL;

class CampaignCollection extends ResourceCollection
{ 
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id'=>$data->id,
                    'title' => $data->title,
                    'image' => URL::to('/images/campaign/'.$data->image), 
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
