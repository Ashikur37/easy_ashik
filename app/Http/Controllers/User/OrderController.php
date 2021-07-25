<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\PartialPayment;
use App\Model\UserTrackOrder;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('customer_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        return view('user.order.index', compact('orders'));
    }
    public function show($number)
    {
        $order = Order::where('customer_id', auth()->user()->id)->where('order_number', $number)->firstOrFail();
        $items = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('user.order.show', compact('order', 'items'));
    }
    public function status($id)
    {
        return view('user.order.status');
    }

    public function orderTrack($number)
    {
        $order = Order::where('order_number', $number)->firstOrFail();
        $tracks = [];
        if (auth()->check()) {
            $tracks = UserTrackOrder::where('user_id', auth()->user()->id)->limit(5)->latest()->get();
            UserTrackOrder::create([
                "order_number" => $number,
                "user_id" => auth()->user()->id
            ]);
        }
        return view('front.order-track', compact('order', 'tracks'));
    }
    public function orderTrackCheck($number)
    {
        $order = Order::where('order_number', $number)->first();
        if ($order) {
            return true;
        } else {
            return false;
        }
    }
    public function print($number)
    {
        $order = Order::where('order_number', $number)->firstOrFail();
        $items = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('user.order.print', compact('order', 'items'));
    }
    public function cashOnDelivery(Order $order)
    {
        //check cash on delivery
        if (auth()->user()->id != $order->customer_id) {
            return;
        }
        $order->update([
            "payment_method" => "Cash On Delivery",
        ]);
        $order->tracks()->create([
            "title" => "Cash on delivery",
            "details" => "Payment set to cash on delivery",
        ]);
        return back()->with('success', "Payment update to cash on delivery");
    }
    public function partialPayment(Order $order, Request $request)
    {
        $tid = uniqid();
        $partialPayment = PartialPayment::create([
            "trans_id" => $tid,
            "amount" => $request->amount,
            "order_id" => $order->id,
            "status" => 0,
        ]);
        $order = Order::find($partialPayment->order_id);
        $post_data = array();
        $post_data['total_amount'] = $partialPayment->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $partialPayment->trans_id; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $order->customer_first_name;
        $post_data['cus_email'] = $order->customer_email;

        $post_data['cus_add1'] = $order->billing_address_1;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $order->customer_phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $order->id;
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');
    }
}
