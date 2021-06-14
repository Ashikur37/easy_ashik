<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ShopCollection;
use App\Model\Category;
use App\Model\Product;
use App\Model\Shop;
use App\Model\Vendor;
use App\User;
use URL;

class ShopController extends Controller
{

    public function index()
    {
        return new ShopCollection(Shop::where('is_active', 1)->limit(6)->get());
    }
    public function product(Shop $shop)
    {

        return new ProductCollection(Product::where('shop_id', $shop->id)->orderBy('id', 'desc')->paginate(10));
    }
    public function store(Product $product)
    {
        $name = "";
        $image = "";
        $phone = "";
        $address = "";
        if ($product->user_id) {
            $vendor = Vendor::where('user_id', $product->user_id)->first();
            $name = $vendor->store_name;
            $phone = $vendor->phone;
            $address = $vendor->address;
            $image = URL::to('images/user/' . User::find($product->user_id)->avatar);
        } else {
            if ($product->shop_id) {
                $shop_id = $product->shop_id;
            } else {
                $shop_id = 1;
            }
            $shop = Shop::find($shop_id);
            $name = $shop->name;
            $phone = $shop->phone;
            $address = $shop->location;
            $image = URL::to('images/shop/' . $shop->image);
        }
        return [
            "data" => [
                "name" => $name,
                "image" => $image,
                "phone" => $phone,
                "address" => $address
            ]
        ];
    }
    public function storeProduct(Product $product)
    {
        if ($product->user_id) {

            $products = Product::where('user_id', $product->user_id)->orderBy('id', 'desc')->paginate(10);
        } else if ($product->shop_id) {
            $products = Product::where('shop_id', $product->shop_id)->orderBy('id', 'desc')->paginate(10);
        } else {
            $products = Product::where('shop_id', 1)->orderBy('id', 'desc')->paginate(10);
        }
        return new ProductCollection($products);
    }
}
