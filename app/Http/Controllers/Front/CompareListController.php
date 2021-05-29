<?php  
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Cart;

class CompareListController extends Controller
{

    public function index(){
       $items=Cart::instance('compare-list')->content();
        return view('front.compare',compact('items'));
    }
    public function addItem(){
        $product=Product::find(request()->id);
        Cart::instance('compare-list')->add(request()->id, $product->name, 1,$product->getSpecialPrice(), 0,[
            "name"=>$product->name,
            "image"=>$product->image,
            "details"=>$product->details,
            "rating"=>$product->reviews->avg('rating'),
            "stock"=>($product->in_stock==1&&$product->qty>0)?true:false,
            "sizes"=>$product->sizes,
            "colors"=>$product->colors,
            "brand"=>$product->brand,
         ]);
    }
    public function removeItem($row){
        Cart::instance('compare-list')->remove($row);
        $items= Cart::instance('compare-list')->content();  
        return view('load.front.compare',compact('items'));
    }
}