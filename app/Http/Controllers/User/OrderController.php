<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\UserTrackOrder;

class OrderController extends Controller
{

    public function index()
    {
        $orders=Order::where('customer_id',auth()->user()->id)->orderBy('id','desc')->paginate(10);
        return view('user.order.index',compact('orders')); 
    }
    public function show($number)
    {
        $order=Order::where('customer_id',auth()->user()->id)->where('order_number',$number)->firstOrFail();
        $items = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('user.order.show',compact('order','items'));
    }
    public function status($id)
    {
        return view('user.order.status');
    }

    public function orderTrack($number)
    {
        $order= Order::where('order_number',$number)->firstOrFail();
        $tracks=[];
        if(auth()->check()){
            $tracks=UserTrackOrder::where('user_id',auth()->user()->id)->limit(5)->latest()->get();
            UserTrackOrder::create([
                "order_number"=>$number,
                "user_id"=>auth()->user()->id
            ]);
        }
        return view('front.order-track',compact('order','tracks'));
    }
    public function orderTrackCheck($number){
       $order= Order::where('order_number',$number)->first();
        if($order){
            return true;
        }
        else{
            return false;
        }
    }
    public function print($number){
        $order= Order::where('order_number',$number)->firstOrFail();
        $items = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('user.order.print',compact('order','items'));
    }
}
