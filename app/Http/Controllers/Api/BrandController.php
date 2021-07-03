<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ShopCollection;
use App\Http\Resources\VendorCollection;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\Shop;
use App\Model\Vendor;
use App\User;
use URL;

class BrandController extends Controller
{

    public function index()
    {
        return new BrandCollection(Brand::where('is_active', 1)->limit(6)->get());
    }

    public function product(Brand $brand)
    {

        return new ProductCollection(Product::where('brand_id', $brand->id)->orderBy('id', 'desc')->paginate(10));
    }
}
