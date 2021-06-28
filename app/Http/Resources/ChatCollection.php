<?php

namespace App\Http\Resources;

use App\Model\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Utility\CategoryUtility;
use Illuminate\Support\Facades\URL;

class ChatCollection extends ResourceCollection
{
    public function toArray($request)
    {
        //50-10*100/50
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id' => $data->product->id,

                    'message' => $data->messages->last()->message,
                    'product_name' => $data->product->name,
                    'product_image' => URL::to('images/product/' . $data->product->image),
                    'sent' => $data->messages->last()->created_at->format('h:i a d-M-y')
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
