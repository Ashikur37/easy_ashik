<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Model\Coupon;
use App\Model\Currency;
use App\Model\Order;
use App\Model\PaymentGateway;
use App\Model\PaymentSetting;
use App\Model\Product;
use App\Model\Setting;
use App\Model\ShippingMethod;
use App\Model\Transaction as ModelTransaction;
use App\Model\UserAddress;
use App\Services\AffiliateService;
use App\Services\LanguageService;
use App\Services\MailService;
use App\User;
use App\VendorOrder;
use Illuminate\Support\Facades\Session;
use Cart;
use Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Stripe;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    //payment method's configuration
    private $_api_context;
    private $stripe_secret;
    public function __construct()
    {
        $ps = PaymentSetting::first();
        Config::set('paypal.mode', $ps->paypal_mode);
        Config::set('paypal.client_id', $ps->paypal_client);
        Config::set('paypal.secret', $ps->paypal_secret);
        $this->stripe_secret = $ps->stripe_secret;
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
        $this->keyId = $ps->razorpay_key;
        $this->keySecret = $ps->razorpay_secret;
        $this->displayCurrency = Session::get('currency')->name;
        $this->api = new Api($this->keyId, $this->keySecret);
    }
    public function index()
    {
        $setting = Setting::first();
        //Checking if guest  checkout is off
        if (!$setting->guest_checkout) {
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', LanguageService::getTranslate('PleaseLoginToOrder'));
            }
        }
        //Redirect to home if cart is empty
        if (count(Cart::content()) == 0) {
            return redirect()->route('home')->with('error', LanguageService::getTranslate('EmptyCart'));
        }
        $countries = json_decode($setting->supported_countries);
        $paymentGateways = PaymentGateway::where('is_active', 1)->get();
        $shippingMethods = ShippingMethod::where('is_active', 1)->get();
        $paymentSetting = PaymentSetting::first();
        $addresses = UserAddress::where('user_id', auth()->id())->get();
        $items = Cart::content();

        return view('front.checkout', compact('items', 'countries', 'addresses', 'paymentGateways', 'shippingMethods', 'paymentSetting'));
    }
    public function checkoutSubmit(OrderRequest $request)
    {

        $address = UserAddress::find($request->address_id);
        $cashback = 0;


        $cart = utf8_encode(bzcompress(serialize(Cart::content()), 9));

        $curr = Currency::first();
        $item_number = "EMT" . rand(100000, 999999) . date('d');
        $shippingMethod = ShippingMethod::first();
        $charge = 0;
        $advanceCharge = 0;
        $cod = 1;
        foreach (Cart::content() as $item) {
            $product = Product::find($item->options->productId);
            if ($product->campaign_id != 0 || $product->is_cod == 0) {
                $cod = 0;
            }
            if ($address->region == "Inside Dhaka") {
                $charge += $product->inside_charge;
            } else {
                $charge += $product->outside_charge;
            }

            if ($product->advance_delivery_charge) {
                if ($address->region == "Inside Dhaka") {
                    $advanceCharge += $product->inside_charge;
                } else {
                    $advanceCharge += $product->outside_charge;
                }
            }

            $cashback += $item->qty * $product->cashback;
        }
        $order = Order::create([
            'is_cod' => $cod,
            'advance_shipping_cost' => $advanceCharge,
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
        //create the order
        $cashback = 0;
        foreach (Cart::content() as $item) {
            $product = Product::find($item->options->productId);
            $quantities = [];
            $prices = [];
            if (isset($quantities[$product->user_id])) {
                $quantities[$product->user_id] += $item->qty;
                $prices[$product->user_id] += $item->subtotal;
            } else {
                $quantities[$product->user_id] = $item->qty;
                $prices[$product->user_id] = $item->subtotal;
            }
            VendorOrder::updateOrCreate(
                [
                    "user_id" => $product->user_id,
                    "order_id" => $order->id
                ],
                [
                    "quantity" => $quantities[$product->user_id],
                    "price" => $prices[$product->user_id],
                    "status" => 0
                ]
            );
            $cashback += $item->qty * $product->cashback;
            $order->products()->create([
                "product_id" => $item->options->productId,
                "unit_price" => $item->price,
                "qty" => $item->qty,
                "line_total" => $item->subtotal
            ]);
        }
        $order->cashback = $cashback;
        $order->save();
        $order->tracks()->create([
            "title" => "Pending",
            "details" => "Order placed successfully ",
        ]);
        $data =  MailService::singleSms($address->mobile, "Your order placed successfully. Order ID " . $item_number, uniqid());
        Cart::destroy();
        //Save payment additional data
        return redirect('user/order/' . $order->order_number);
    }
    public function loadPayment(PaymentGateway $paymentGateway)
    {
        return view('load.front.payment-additional', compact('paymentGateway'));
    }
    public function shippingMethod(ShippingMethod $shippingMethod)
    {
        return Product::currencyPriceRate(Cart::total() + $shippingMethod->payablePrice());
    }
}
