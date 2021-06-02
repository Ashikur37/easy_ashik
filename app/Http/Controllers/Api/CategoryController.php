<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\SubCategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Model\Category;
use App\Model\SubCategory;
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
    public function subCatProduct(SubCategory $subCategory){
        
        return new ProductCollection(Product::where('sub_category_id',$subCategory->id)->orderBy('id','desc')->paginate(10));
    }
    //subCatProduct
    public function subCategory(Category $category){
        
        return new SubCategoryCollection($category->subCategories);
    }


}