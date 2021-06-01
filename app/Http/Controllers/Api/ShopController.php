<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ShopCollection;
use App\Model\Category;
use App\Model\Product;
use App\Model\Shop;

class ShopController extends Controller
{

    public function index()
    {
        return new ShopCollection(Shop::where('is_active', 1)->limit(6)->get());
    }
    public function product(Shop $shop){
        
        return new ProductCollection(Product::where('shop_id',$shop->id)->orderBy('id','desc')->paginate(10));
    }


}