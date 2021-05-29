<?php  
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Model\Attribute;
use App\Model\AttributeValue;
use App\Model\Brand;
use App\Model\Color;
use App\Model\Currency;
use App\Model\Product;
use App\Model\ProductAttribute;
use App\Model\ProductColor;
use App\Model\ProductComment;
use App\Model\ProductSize;
use App\Model\Setting;
use App\Model\Size;
use App\Model\Tag;
use Illuminate\Http\Request;
use App\Services\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Cart;
class ProductController extends Controller
{

    public function show($slug){
        
        $product=Product::whereSlug($slug)->firstOrFail();
        $product->viewed+=1;
        $product->save();
        $items= Cart::instance('compare-list')->content();  
        $inCompareList=false;
        foreach($items as $item){
            if($item->id==$product->id){
                $inCompareList=true;
            }
        }
        $rating=$product->reviews->avg('rating');
        $relatedProducts=new Collection();
        if($product->child_category){
            $relatedProducts=$relatedProducts->push(Product::where('child_category_id',$product->child_category_id)->where('id','!=',$product->id)->take(5)->get());
        }
        if($product->sub_category){
            $relatedProducts=$relatedProducts->push(Product::where('sub_category_id',$product->sub_category_id)->where('id','!=',$product->id)->take(5)->get());
        } 
        $relatedProducts=$relatedProducts->push(Product::where('category_id',$product->category_id)->where('id','!=',$product->id)->take(4)->get());
        $relatedProducts= $relatedProducts[0];
        $cartProducts=[]; 
        $items= Cart::content();
        foreach($items as $item){
            $cartProducts[$item->id]= [
                "qty"=>$item->qty,
                "rowId"=>$item->rowId,
            ];
        }
        return view('front.product',compact('product','rating','relatedProducts','inCompareList','cartProducts'));
    }
    public function comment(Request $request,Product $product){
        $comment=$product->comments()->create([
            "user_id"=>auth()->user()->id,
            "text"=>$request->text
        ]);
        
        Notification::adminProductComment($comment->id);
        return redirect()->back()->with('success','comment added');
    }
    public function commentReply(Request $request,ProductComment $productComment){
        $reply=$productComment->replies()->create([
            "user_id"=>auth()->user()->id,
            "text"=>$request->text
        ]);
        Notification::adminProductCommentReply($reply->id);
        return redirect()->back()->with('success','Reply added');
    }
    public function review(Request $request,Product $product){
        $setting=Setting::first();
        $review=$product->reviews()->create([
            "reviewer_id"=>auth()->user()->id,
            "comment"=>$request->comment,
            "rating"=>$request->star,
            "title"=>$request->title,
            "is_approved"=>$setting->auto_approval_review
        ]);
        Notification::adminProductReview($review->id);
        return redirect()->back()->with('success','Review added');
    }
    public function tagProduct($name){
        $tag=Tag::whereName($name)->first();
        $cartProducts=[]; 
        $items= Cart::content();
        foreach($items as $item){
            $cartProducts[$item->id]= [
                "qty"=>$item->qty,
                "rowId"=>$item->rowId,
            ];
        }
        return view('front.tag',compact('cartProducts','tag'));
        
    }
    public function tagProductSort($name,Request $request){
        $tag=Tag::whereName($name)->first();
        $sort=[["id","0"],["id","1"],["price","0"],["price","1"],["name","0"],["name","1"],["rating_percent","1"],["viewed","1"]][$request->sort];

        if($sort[1]==0){
            $products=$tag->products->sortBy($sort[0]);
        }
        else{
            $products=$tag->products->sortByDesc($sort[0]);
        }
        $cartProducts=[]; 
        $items= Cart::content();
        foreach($items as $item){
            $cartProducts[$item->id]= [
                "qty"=>$item->qty,
                "rowId"=>$item->rowId,
            ];
        }
        return view('load.front.flash-sale',compact('cartProducts','products'));
    }
    public function brandProduct($name){ 
        $brand=Brand::whereName($name)->first();
        $products=$brand->products->paginate(9);
        
        $ids=$products->pluck('id')->toArray();
        $colorIds=ProductColor::whereIn('product_id',$ids)->distinct()->get(['color_id']);
        $colors=Color::whereIn('id',$colorIds)->get();
        $sizeIds=ProductSize::whereIn('product_id',$ids)->distinct()->get(['size_id']);
        $sizes=Size::whereIn('id',$sizeIds)->get();

        $attributeIds=ProductAttribute::whereIn('product_id',$ids)->distinct()->get(['attribute_id']);
        $attributes=Attribute::whereIn('id',$attributeIds)->get(['id','name']);
        foreach($attributes as $attribute){
            $productAttributeIds=ProductAttribute::where('attribute_id',$attribute->id)->whereIn('product_id',$ids)->get('id');
             $attribute["datas"]=AttributeValue::whereHas('productAttributeValues',function($q) use($productAttributeIds){
                $q->whereIn('product_attribute_id',$productAttributeIds);
            })->get(['value','id']);

        }
        $view="grid";
        $maxPrice=$products->max('price');
        $minPrice=$products->min('price');

        $cartProducts=[]; 
        $items= Cart::content();
        foreach($items as $item){
            $cartProducts[$item->id]= [
                "qty"=>$item->qty,
                "rowId"=>$item->rowId,
            ];
        }
        return view('front.brand',compact('cartProducts','brand','view','products','maxPrice','minPrice','colors','sizes','attributes'));
        
    }
    public function brandProductSort($name,Request $request){
        $brand=Brand::whereName($name)->first();
        $sort=[["id","0"],["id","1"],["price","0"],["price","1"],["name","0"],["name","1"],["rating_percent","1"],["viewed","1"]][$request->sort];

        $min_price=$request->min;
        $max_price=$request->max;

        $colors=json_decode($request->colors);
        $sizes=json_decode($request->sizes);
        $view=$request->view;
        $attributes=json_decode($request->attrs);
        if (Session::has('currency'))
        {
            $curr = Session::get('currency');
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }
        $rate=$curr->rate;
        $products = Product::where('brand_id',$brand->id)->when($colors, function ($query, $colors) {
            return $query->whereHas('colors', function($q) use ($colors){
                $q->whereIn('color_id',$colors);
            });
        })
        ->when($attributes, function ($query, $attributes) {
            return $query->whereHas('attributeValues', function($q) use ($attributes){
                $q->whereIn('attribute_value_id',$attributes);
            });
        })
        ->when($sizes, function ($query, $sizes) {
            return $query->whereHas('sizes', function($q) use ($sizes){
                $q->whereIn('size_id',$sizes);
            });
        })->get();
        
        if($sort[1]==0){
            $products=$products->sortBy($sort[0]);
        }
        else{
            $products=$products->sortByDesc($sort[0]);
        }
        $products=$products->filter(function($product) use($min_price,$max_price){
            return $product->price>=$min_price&&$product->price<=$max_price;
        });
            $products=(new Collection($products))->paginate(request()->pageLength);
            $cartProducts=[]; 
            $items= Cart::content();
            foreach($items as $item){
                $cartProducts[$item->id]= [
                    "qty"=>$item->qty,
                    "rowId"=>$item->rowId,
                ];
            }
            return view('load.front.category',compact('cartProducts','products','min_price','max_price','view'));
    }
}