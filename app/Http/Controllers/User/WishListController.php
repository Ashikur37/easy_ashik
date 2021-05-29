<?php  
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\WishList;
use Session;

class WishListController extends Controller
{

    public function index(){
        $productIds=WishList::where('user_id',auth()->user()->id)->pluck('product_id')->toArray();
        $products=Product::whereIn('id',$productIds)->paginate(10);
        return view('user.wishlist.index',compact('products'));
    }
    public function addItem(){
        $id=request()->id;
        $wishlist=WishList::where('product_id',$id)->where('user_id',auth()->user()->id)->first();
        if($wishlist){
            WishList::where('product_id',$id)->where('user_id',auth()->user()->id)->delete();
            Session::put('wishCount',WishList::where('user_id', auth()->user()->id)->count());
            Session::put('wishProducts',WishList::where('user_id', auth()->user()->id)->pluck('product_id')->toArray());
            return 0;
        }
        else{
            WishList::updateOrCreate([
                'user_id'=>auth()->user()->id,
                'product_id'=>$id
            ]);
            Session::put('wishCount',WishList::where('user_id', auth()->user()->id)->count());
            Session::put('wishProducts',WishList::where('user_id', auth()->user()->id)->pluck('product_id')->toArray());
            return 1;
        }
       
    }
    public function removeItem(){
        $id=request()->id;
        $wishlist=WishList::where('product_id',$id)->where('user_id',auth()->user()->id)->delete();
        Session::put('wishCount',WishList::where('user_id', auth()->user()->id)->count());
        Session::put('wishProducts',WishList::where('user_id', auth()->user()->id)->pluck('product_id')->toArray());
        return 1;
    }
}