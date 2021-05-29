<?php

namespace App\Http\Resources;

use App\Model\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Utility\CategoryUtility;
use Illuminate\Support\Facades\URL;

class ProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id'=>$data->id,
                    'name' => $data->name,
                    'image' => URL::to('/images/product/'.$data->image), 
                    'price'=>Product::currencyPrice($data->price),
                    'old_price'=>$data->actualPrice(),
                    'slug'=>route('product.show',$data->slug),
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
