<?php  
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Model\Order;

class OrderController extends Controller
{

    public function index(){
      
        $orders=Order::where('customer_id',auth()->user()->id)->latest()->get();
        return new OrderCollection($orders);
    }
    public function show(Order $order){

        $carts = unserialize(bzdecompress(utf8_decode($order->cart)));
        $items=[];
        foreach($carts as $cart){
            array_push($items,$cart);
        }
        return [
            "data"=>[
                "order"=>$order,
                "items"=>$items
            ]
        ];

    }

}