<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderTrackCollection;
use App\Model\Order;
use App\Model\PartialPayment;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Model\CampaignProduct;
use App\Model\FlashSaleProduct;
use App\Model\Product;
use App\Model\UserAddress;
use App\User;

class OrderController extends Controller
{

    public function index()
    {

        $orders = Order::where('customer_id', auth()->user()->id)->latest()->get();
        return new OrderCollection($orders);
    }
    public function show(Order $order)
    {

        $carts = unserialize(bzdecompress(utf8_decode($order->cart)));
        $items = [];
        foreach ($carts as $cart) {
            array_push($items, $cart);
        }

        return [
            "data" => [
                "order" => $order,
                "items" => $items,
                "due" => $order->total - $order->paid_amount,
                "shop_name" => "Easymert",
                "address" => "84/A/B 2nd clony,\n Mazar Road,Mirpur-1,\nDhaka-1216",
                "phone" => "01407090450",

                "tracks" => new OrderTrackCollection($order->tracks)
            ]
        ];
    }
    public function cashOnDelivery(Order $order)
    {

        $order->update([
            "payment_method" => "Cash On Delivery",
        ]);
        $order->tracks()->create([
            "title" => "Cash on delivery",
            "details" => "Payment set to cash on delivery",
        ]);
        return [
            "success" => true,
            "msg" => "cash on delivery"
        ];
    }
    //changeAddress
    public function changeAddress(Order $order, Request $request)
    {
        $address = UserAddress::find($request->address_id);
        $order->tracks()->create([
            "title" => "Processing",
            "details" => "Customer changed the delivery address to " . $address->street_address,
        ]);
        $order->update([
            'customer_email' => $address->email,
            'customer_phone' => $address->mobile,
            'customer_first_name' => $address->first_name,
            'customer_last_name' => $address->last_name,
            'billing_first_name' => $address->first_name,
            'billing_last_name' => $address->last_name,
            'billing_address_1' => $address->street_address,
        ]);
        return [
            "success" => true,
            "msg" => "Address updated successfully"
        ];
    }
    public function cancelOrder(Order $order, Request $request)
    {
        if ($order->status < 3) {
            $order->update([
                "status" => 6,
                "cancel_reason" => $request->cancel_reason
            ]);
            $order->tracks()->create([
                "title" => "Canceled",
                "details" => "Order canceled successfully",
            ]);
            return [
                "success" => true,
                "msg" => "Order canceled successfully"
            ];
        }
    }
    public function payWithBalance(Order $order)
    {
        $user = User::find($order->customer_id);
        if ($user->easy_balance < $order->total) {
            return [
                "success" => false,
                "msg" => "Payment failed"
            ];
        }
        $user->easy_balance -= $order->total;
        $user->save();
        $order->update([
            "status" => 2,
            "payment_status" => 1,
            "paid_amount" => $order->total

        ]);
        $items = unserialize(bzdecompress(utf8_decode($order->cart)));
        foreach ($items as $item) {
            $product = Product::find($item->options->productId);
            $campaignProducts = CampaignProduct::where('product_id', $product->id)->get();
            foreach ($campaignProducts as $campProduct) {
                $campProduct->qty -= $item->qty;
                $campProduct->save();
            }
            $flashProducts = FlashSaleProduct::where('product_id', $product->id)->get();
            foreach ($flashProducts as $flashProduct) {
                $flashProduct->qty -= $item->qty;
                $flashProduct->save();
            }
            $product->qty -= $item->qty;
            $product->save();
        }
        $order->tracks()->create([
            "title" => " Confirmed",
            "details" => "Order Confirmed",
        ]);
        $order->tracks()->create([
            "title" => "Processing",
            "details" => "Order Processing",
        ]);
        return [
            "success" => true,
            "msg" => "Paid Successfully"
        ];
    }
    //confirmOrder
    public function confirmOrder(Order $order, Request $request)
    {
        $order->update([
            "status" => 2
        ]);
        $order->tracks()->create([
            "title" => " Confirmed",
            "details" => "Order Confirmed",
        ]);
        $order->tracks()->create([
            "title" => "Processing",
            "details" => "Order Processing",
        ]);
        $items = unserialize(bzdecompress(utf8_decode($order->cart)));
        foreach ($items as $item) {
            $product = Product::find($item->options->productId);
            $campaignProducts = CampaignProduct::where('product_id', $product->id)->get();
            foreach ($campaignProducts as $campProduct) {
                $campProduct->qty -= $item->qty;
                $campProduct->save();
            }
            $flashProducts = FlashSaleProduct::where('product_id', $product->id)->get();
            foreach ($flashProducts as $flashProduct) {
                $flashProduct->qty -= $item->qty;
                $flashProduct->save();
            }
            $product->qty -= $item->qty;
            $product->save();
        }
        return [
            "success" => true,
            "msg" => "Order Confirmed Successfully"
        ];
    }
    public function partialPayment(Order $order, Request $request)
    {
        $tid = uniqid();
        $payment = PartialPayment::create([
            "trans_id" => $tid,
            "amount" => $request->amount,
            "order_id" => $order->id,
            "status" => 0,
        ]);
        return [
            "data" => [
                "id" => $payment->id
            ]
        ];
    }
    public function deliveryPayment(Order $order, Request $request)
    {

        $tid = uniqid();
        $order->update([
            'delivery_trx_id' => $tid
        ]);
        $post_data = array();
        $post_data['total_amount'] = $order->shipping_cost; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $tid; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $order->customer_first_name;
        $post_data['cus_email'] = $order->customer_email;
        $post_data['cus_add1'] = $order->billing_address_1;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
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
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');
    }

    public function payScreen(PartialPayment $partialPayment)
    {
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
