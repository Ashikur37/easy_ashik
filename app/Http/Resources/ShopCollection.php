<?php

namespace App\Http\Resources;

use App\Model\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Utility\CategoryUtility;
use Illuminate\Support\Facades\URL;

class ShopCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id'=>$data->id,
                    'name' => $data->name,
                    'image' => URL::to('/images/shop/'.$data->image), 
                    'phone'=>$data->phone,
                    'location'=>$data->location,
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
