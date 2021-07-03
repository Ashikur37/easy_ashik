<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Color;
use App\Model\Currency;
use App\Model\Order;
use Illuminate\Http\Request;
use Cart;
use Config;
use App\Model\PaymentSetting;
use App\Model\Product;
use App\Model\ProductColor;
use App\Model\ProductSize;
use App\Model\ShippingMethod;
use App\Model\Size;
use App\Model\UserAddress;
use App\Services\MailService;
use Log;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $paymentSetting = PaymentSetting::first();
        Config::set('cart.tax', $paymentSetting->tax);
    }

    public function store(Request $request)
    {
        // return dd($request->all()); 
        $charge = 0;
        $address = UserAddress::find($request->address_id);
        $cashback = 0;
        foreach ($request->products as $prod) {
            $product = Product::find($prod["id"]);
            if ($address->region == "Inside Dhaka") {
                $charge += $product->inside_charge;
            } else {
                $charge += $product->outside_charge;
            }
            //generate id for variation
            $colorCode = "";
            $colorName = "";
            $sizeName = "";
            $rowId = $product["id"] . $prod["color"] . $prod["size"];
            $price = $product->getSpecialPrice();
            $cashback += $product["cashback"] * $prod["quantity"];
            if ($product->size) {
                $size = Size::find($prod["size"]);
                $price += ProductSize::where('size_id', $prod["size"])->where('product_id', $prod["id"])->first()->price;
                $sizeName = $size->name;
            }
            if ($product->color) {
                $color = Color::find($prod["color"]);
                $price += ProductColor::where('color_id', $prod["color"])->where('product_id', $prod["id"])->first()->price;
                $colorCode = $color->code;
                $colorName = $color->name;
            }
            Cart::add($rowId, $product->name, $prod["quantity"], $price, 0, [
                "productId" => $product["id"],
                "image" => $product->image,
                "slug" => $product->slug,
                "size" => $sizeName,
                "color" => $colorCode,
                "options" => [],
                "colorName" => $colorName
            ]);
        }



        $shippingMethod = ShippingMethod::first();
        //compress the cart data to save in database
        $cart = utf8_encode(bzcompress(serialize(Cart::content()), 9));
        $curr = Currency::first();
        $item_number = "EMT" . rand(100000, 999999) . date('d');
        //create the order

        $order = Order::create([
            'order_number' => $item_number,
            'customer_id' => auth()->user()->id,
            'customer_email' => $address->email,
            'customer_phone' => $address->mobile,
            'customer_first_name' => $address->first_name,
            'customer_last_name' => $address->last_name,
            'billing_first_name' => $address->first_name,
            'billing_last_name' => $address->last_name,
            'billing_address_1' => $address->street_address,
            'billing_address_2' => $request->billing_address_2 ?? null,
            'billing_city' => $address->city,
            'billing_state' => "State",
            'billing_zip' => $address->zip,
            'billing_country' => "Country",
            'shipping_first_name' => $address->first_name,
            'shipping_last_name' => $address->last_name,
            'shipping_address_1' => $address->street_address,
            'shipping_address_2' => $request->shipping_address_2 ? $request->shipping_address_2 : null,
            'shipping_city' => $address->city,
            'shipping_state' => "State",
            'shipping_zip' => $address->zip,
            'shipping_country' => "Country",
            'sub_total' => Cart::subtotal(),
            'shipping_method' => $shippingMethod->name,
            'shipping_cost' => $charge,
            'coupon_id' => 0,
            'discount' => Cart::discount(),
            'total' => Cart::total() + $charge,
            'tax' => Cart::tax(),
            'payment_method' => $request->payment_method,
            'currency' => $curr->name,
            'currency_rate' => $curr->rate,
            'locale' => 'EN',
            'status' => 0,
            'payment_method' => "Pending",
            'note' => $request->note,
            "cart" => $cart,
            "affiliator" => 0,
            "cashback" => $cashback
        ]);
        $order->tracks()->create([
            "title" => "Pending",
            "details" => "Order placed successfully ",
        ]);
        $data =  MailService::singleSms($address->mobile, "Your order placed successfully. Order ID " . $item_number, uniqid());
        return [
            "id" => $order->id
        ];
    }
}
