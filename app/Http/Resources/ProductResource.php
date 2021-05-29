<?php

namespace App\Http\Resources;

use App\Model\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "rating"=>$this->rating,
            "image"=>$this->image,
            'price'=>Product::currencyPrice($this->price),
            'old_price'=>$this->actualPrice(),
            "images"=>$this->images,
            "details"=>$this->details,
        ];
    }
}
