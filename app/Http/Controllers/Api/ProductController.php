<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\BusinessSetting;
use App\Model\Category;
use App\Model\Product;

class ProductController extends Controller
{

    public function show(Product $product)
    {
        $product->update([
            "viewed" => $product->viewed + 1
        ]);
        return new ProductResource($product);
    }
    public function search($key)
    {
        $products = Product::where("is_offer", 0)->where('name', 'like', '%' . $key . '%')->where('is_active', 1)->orderBy('name')->paginate(10);
        return new ProductCollection($products);
    }
    public function topProducts()
    {
        $products = Product::where("is_offer", 0)->orderBy('viewed', 'desc')->paginate(10);
        return new ProductCollection($products);
    }
}
