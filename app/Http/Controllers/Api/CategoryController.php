<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Model\Category;
use App\Model\Product;

class CategoryController extends Controller
{

    public function index()
    {
        return new CategoryCollection(Category::where('status', 1)->get());
    }
    public function product(Category $category){
        
        return new ProductCollection(Product::where('category_id',$category->id)->orderBy('id','desc')->paginate(10));
    }


}