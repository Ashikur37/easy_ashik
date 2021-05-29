<?php  
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Model\Color;
use App\Model\Coupon;
use App\Model\Option;
use App\Model\OptionValue;
use App\Model\PaymentSetting;
use App\Model\Product;
use App\Model\ProductColor;
use App\Model\ProductSize;
use App\Model\ShippingMethod;
use App\Model\Size;
use App\Services\LanguageService;
use Cart;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct()
    {
        $paymentSetting=PaymentSetting::first();
        Config::set('cart.tax', $paymentSetting->tax);
    }

    public function index(){  
        $items= Cart::content();
        $cartProducts=[];
        return view('front.cart',compact('items'));
    }
    public function setQuantity(Request $request){
        
    }
    public function increament($row){
        $item=Cart::get($row);
      
        $item=Cart::get($row);
        $product = Product::find($item->options->productId); 
        if(!$product->inStock($item->qty+1)){
            $data["status"]=-1;
            return response()->json($data);
        }
        Cart::update($row,  $item->qty+1); 
        $data["qty"]=$item->qty;
        $data["row_total"]= Product::currencyPriceRate($item->subtotal());
        $data["sub_total"]=Product::currencyPriceRate(Cart::subtotal());
        $data["total"]=Product::currencyPriceRate(Cart::total());
        $data["tax"]=Product::currencyPriceRate(Cart::tax());
        $data["status"]=1;
        $data["discount"]=Product::currencyPriceRate(Cart::discount());
        return response()->json($data);
        
    }
    public function decreament($row){
        $item=Cart::get($row);
        Cart::update($row,  $item->qty-1);
        $item=Cart::get($row);
        $data["qty"]=$item->qty;
        $data["row_total"]= Product::currencyPriceRate($item->subtotal());
        $data["sub_total"]=Product::currencyPriceRate(Cart::subtotal());
        $data["total"]=Product::currencyPriceRate(Cart::total());
        $data["tax"]=Product::currencyPriceRate(Cart::tax());
        $data["discount"]=Product::currencyPriceRate(Cart::discount());
        $data["status"]=1;
        return response()->json($data);
    }
    public function loadCart(){
        $items= Cart::content();  
        return view('load.front.cart',compact('items'));
    }
    public function removeItem($row){
        Cart::remove($row);
        $items= Cart::content();  
        return view('includes.front.cart',compact('items'));
    }

    public function removeCoupon(){
        Session::forget('coupon');
        $items= Cart::content();
            foreach($items as $item){
                    Cart::setDiscount($item->rowId, 0);
            }
            if(request()->ref){
                $shippingPrice=0;
                if(request()->shipping){
                    $shippingMethod=ShippingMethod::find(request()->shipping);
                    if($shippingMethod){
                        $shippingPrice=$shippingMethod->payablePrice();
                    }
                }
                return view('load.front.checkout-cart',compact('items','shippingPrice'));
            }
        return view('load.front.cart',compact('items'));
    }

    public function applyCoupon($name){
        if(Session::has('coupon')){
            return -1;
        }
        $coupon=Coupon::whereCode($name)->first();
        
        if(!$coupon){
            //coupon does not exist
            return 0;
        }
        else if(!$coupon->isValid()){
            //coupon is expired or has no limit
            return 1; 
        }
        
        else if(Cart::total()<$coupon->min||Cart::total()>$coupon->max){
            return 2;
        }
        else{
            //valid coupon
            Session::put('coupon',$name);
            $items= Cart::content();
            foreach($items as $item){
                if($coupon->hasProduct($item->options->productId)){
                    Cart::setDiscount($item->rowId, $coupon->discountRate($item->price)); 
                    if($coupon->is_percent==0){
                        break;
                    }
                }
            }
            if(request()->ref){
                $shippingPrice=0;
                if(request()->shipping){
                    
                    $shippingMethod=ShippingMethod::find(request()->shipping);
                    if($shippingMethod){
                        $shippingPrice=$shippingMethod->payablePrice();
                    }
                }
                return view('load.front.checkout-cart',compact('items','shippingPrice'));
            }
            return view('load.front.cart',compact('items'));

        }
    }
    public function addItem(Request $request){
       
        $product = Product::find($request->productId); 
        //generate id for variation
        $colorCode="";
        $colorName="";
        $sizeName="";
        $rowId = $product->id.$request->color.$request->size; // generate a unique() row ID
        if($request->optionValues){
            foreach($request->optionValues as $value){
                $rowId.=$value;
            }
        }
        //checkstock
        $items= Cart::content();
        $qty=1;
        foreach($items as $item){
            if($item->id==$rowId){
                $qty+=$item->qty;
            }
        }
        $options=[];
       $price=$product->getSpecialPrice();
        if($request->optionIds){
            for($i=0;$i<count($request->optionIds);$i++){
                $name=Option::find($request->optionIds[$i])->name;
                $value=OptionValue::find($request->optionValues[$i]);
                $options[$name]=$value->label;
                $price+=$value->price;
            }
        }
        if($request->size){
            $size=Size::find($request->size);
            $price+=ProductSize::where('size_id',$request->size)->where('product_id',$request->productId)->first()->price;
            $sizeName=$size->name;
        }
        if($request->color){
            $color=Color::find($request->color);
            $price+=ProductColor::where('color_id',$request->color)->where('product_id',$request->productId)->first()->price;
            $colorCode=$color->code;
            $colorName=$color->name;
        } 
        if($product->inStock($qty)){
           return Cart::add($rowId, $product->name, 1, $price, 0,[
               "productId"=>$product->id,
               "image"=>$product->image,
                "slug"=>$product->slug,
                "size"=>$sizeName,
                "color"=>$colorCode,
                "options"=>$options,
                "colorName"=>$colorName
            ]);
        }
        else{
            return LanguageService::getTranslate("OutOfStock");
        }
    }
    public function getPrice(Request $request){
       
        $product = Product::find($request->productId); 

       $price=$product->getSpecialPrice();
       
        if($request->optionIds){
            for($i=0;$i<count($request->optionIds);$i++){
                $value=OptionValue::find($request->optionValues[$i]);
                $price+=$value->price;
            }
        }
        if($request->size){
           
            $price+=ProductSize::where('size_id',$request->size)->where('product_id',$request->productId)->first()->price;
        }
        if($request->color){
            $price+=ProductColor::where('color_id',$request->color)->where('product_id',$request->productId)->first()->price;

        }
        return Product::currencyPriceRate($price);
    }
    public function getItems(){
           $items= Cart::content();       
           foreach($items as $item){
               return $item->options->image;
           }
    }
}