<?php

namespace App\Http\Resources;

use App\Model\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Utility\CategoryUtility;
use Illuminate\Support\Facades\URL;

class MessageCollection extends ResourceCollection
{
    public function toArray($request)
    {
        //50-10*100/50
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id' => $data->id,
                    'sender_id' => $data->sender_id,
                    'message' => $data->message,
                    'seen' => $data->seen,
                    'sent' => $data->created_at->format('h:i a d-M-y')
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
