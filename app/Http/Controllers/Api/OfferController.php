<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\OfferCollection;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ShopCollection;
use App\Http\Resources\VendorCollection;
use App\Model\Brand;
use App\Model\Category;
use App\Model\FlashSale;
use App\Model\Product;
use App\Model\Shop;
use App\Model\Vendor;
use App\User;
use URL;

class OfferController extends Controller
{

    public function index()
    {
        return new OfferCollection(FlashSale::where('is_active', 1)->limit(6)->get());
    }
    public function vendorList()
    {
        return new VendorCollection(Vendor::orderBy('id', 'desc')->paginate(10));
    }
    public function shops(FlashSale $flashSale)
    {
        $userIds =  $flashSale->flashProducts->pluck('user_id')->unique()->toArray();
        $shopIds =  $flashSale->flashProducts->pluck('shop_id')->unique()->toArray();
        $vendors = new VendorCollection(Vendor::whereIn('user_id', $userIds)->get());
        $shops = new ShopCollection(Shop::whereIn('id', $shopIds)->get());
        return [
            "shops" => $shops,
            "vendors" => $vendors
        ];
    }
    public function brands(FlashSale $flashSale)
    {
        $brands = Brand::whereIn('id', $flashSale->flashProducts->pluck('brand_id')->unique()->toArray())->get();
        return new BrandCollection($brands);
    }

    public function product(FlashSale $flashSale)
    {


        return new ProductCollection($flashSale->flashProducts);
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

    public function merchant(User $user)
    {
        $name = "";
        $image = "";
        $phone = "";
        $address = "";

        $vendor = Vendor::where('user_id', $user->id)->first();
        $name = $vendor->store_name;
        $phone = $vendor->phone;
        $address = $vendor->address;
        $image = URL::to('images/user/' . User::find($user->id)->avatar);

        return [
            "data" => [
                "name" => $name,
                "image" => $image,
                "phone" => $phone,
                "address" => $address
            ]
        ];
    }
    public function merchantProduct(User $user)
    {


        $products = Product::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);
        return new ProductCollection($products);
    }
}
