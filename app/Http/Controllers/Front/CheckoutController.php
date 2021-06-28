<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Model\Coupon;
use App\Model\Order;
use App\Model\PaymentGateway;
use App\Model\PaymentSetting;
use App\Model\Product;
use App\Model\Setting;
use App\Model\ShippingMethod;
use App\Model\Transaction as ModelTransaction;
use App\Services\AffiliateService;
use App\Services\LanguageService;
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
            if(!auth()->check()){
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
        return view('front.checkout', compact('countries', 'paymentGateways', 'shippingMethods', 'paymentSetting'));
    }
    public function checkoutSubmit(OrderRequest $request)
    {
        //Create account if customer want
        if ($request->create_account) {
           $validator= Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();;
            }
            User::create([
                'name' => $request->customer_first_name,
                'lastname' => $request->customer_last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'affiliate_link' => md5($request->email),
                'affiliate_balance' => 0
            ]);
        }
        $affiliator=0;
        if(Session::has('affiliator')){
            $affiliator=Session::get('affiliator');
        }
        $shippingMethod = ShippingMethod::find($request->shipping_method);
        //compress the cart data to save in database
        $cart = utf8_encode(bzcompress(serialize(Cart::content()), 9));
        $coupon_id = 0;
        if (Session::has('coupon')) {
            $coupon = Coupon::whereCode(Session::get('coupon'))->first();
            $coupon_id = $coupon->id;
            $coupon->used++;
            $coupon->save();
        }
        $curr = Session::get('currency');
        $item_number = "EMT".rand(100000,999999).date('d');
        //create the order
        $order = Order::create([
            'order_number' => $item_number,
            'customer_id' => auth()->id(),
            'customer_email' => "Email",
            'customer_phone' => $request->customer_phone,
            'customer_first_name' => $request->customer_first_name,
            'customer_last_name' => "Lastname",
            'billing_first_name' => $request->customer_first_name,
            'billing_last_name' => "Last Name",
            'billing_address_1' => $request->billing_address_1,
            'billing_address_2' => $request->billing_address_2 ?? null,
            'billing_city' => "City",
            'billing_state' => "State",
            'billing_zip' => "ZIP",
            'billing_country' => "Country",
            'shipping_first_name' => $request->shipping_first_name ? $request->shipping_first_name : $request->customer_first_name,
            'shipping_last_name' => "Lastname",
            'shipping_address_1' => "Address",
            'shipping_address_2' => $request->shipping_address_2 ? $request->shipping_address_2 : null,
            'shipping_city' => "City",
            'shipping_state' => "State",
            'shipping_zip' => "ZIP",
            'shipping_country' => "Country",
            'sub_total' => Cart::subtotal(),
            'shipping_method' => $shippingMethod->name,
            'shipping_cost' => $shippingMethod->payablePrice(),
            'coupon_id' => $coupon_id,
            'discount' => Cart::discount(),
            'total' => Cart::total(),
            'tax' => Cart::tax(),
            'payment_method' => $request->payment_method,
            'currency' => $curr->name,
            'currency_rate' => $curr->rate,
            'locale' => 'EN',
            'status' => 0,
            'payment_method' => $request->payment_method,
            'note' => $request->note,
            "cart" => $cart,
            "affiliator"=>$affiliator
        ]);
        //Save payment additional data
        if ($request->additional) {
            foreach ($request->additional as $additional_id => $value) {
                $order->additionals()->create([
                    "payment_gateway_additional_id" => $additional_id,
                    "value" => $value
                ]);
            }
        }
        $cashback=0;
        foreach (Cart::content() as $item) {
            $product=Product::find($item->options->productId);
            $quantities=[];
            $prices=[];
            if(isset($quantities[$product->user_id])){
                $quantities[$product->user_id]+=$item->qty;
                $prices[$product->user_id]+=$item->subtotal;

            }
            else{
                $quantities[$product->user_id]=$item->qty;
                $prices[$product->user_id]=$item->subtotal;
            }
            VendorOrder::updateOrCreate(
                [
                    "user_id"=>$product->user_id,
                    "order_id"=>$order->id
                ],
                [
                    "quantity"=>$quantities[$product->user_id],
                    "price"=>$prices[$product->user_id],
                    "status"=>0
                ]
            );
            $cashback+=$item->qty*$product->cashback;
            $order->products()->create([
                "product_id" => $item->options->productId,
                "unit_price" => $item->price,
                "qty" => $item->qty,
                "line_total" => $item->subtotal
            ]);
        }
        $order->cashback=$cashback;
        $order->save();
        Session::put('order_id', $order->id);
        $order->tracks()->create([
            "title" => "Placement",
            "details" => "Order placed successfully ",
        ]);
        $total = floatval(Cart::total() + $shippingMethod->payablePrice()) * $curr->rate;
        Cart::destroy();
        //check if the payment method is affiliate
        if ($request->payment_method == 'Affiliate') {
            if (auth()->user()->affiliate_balance < $total) {
                return back();
            } else {
                $order->update([
                    "payment_method" => "affiliate",
                    "payment_status" => 1,
                ]);
                $user = User::find(auth()->user()->id);
                $user->affiliate_balance -= $total;
                $user->save();
                $affiliateService = new AffiliateService();
                $affiliateService->payToAffiliator($order->id);
                return redirect()->route('order.success');
            }
        }
        else if($request->payment_method=="SSL Commerz"){

            $post_data = array();
            $post_data['total_amount'] = $total; # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = uniqid(); // tran_id must be unique
    
            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $request->customer_first_name;
            $post_data['cus_email'] = $request->customer_phone;
            $post_data['cus_add1'] = $request->billing_address_1;
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
    
            $order->update([
                "transaction_id"=>$post_data['tran_id'] 
            ]);
            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');
        }
        else if ($request->payment_method == 'Razorpay') {
            $success_url = action('Payment\PaymentController@payreturn');
            $notify_url = action('Payment\RazorPayController@razorCallback');

            $orderData = [
                'receipt'         => $item_number,
                'amount'          => round($total), //
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];
            $razorpayOrder = $this->api->order->create($orderData);
            $razorpayOrderId = $razorpayOrder['id'];
            session(['razorpay_order_id' => $razorpayOrderId]);
            $order->update([
                "payment_method" => "Razorpay"
            ]);
            $displayAmount = $amount = $orderData['amount'];
            $item_name = "Order";
            $checkout = 'automatic';
            $data = [
                "key"               => $this->keyId,
                "amount"            => round($amount),
                "name"              => $item_name,
                "description"       => $item_name,
                "prefill"           => [
                    "name"              => $order->customer_first_name,
                    "email"             => $order->email,
                    "contact"           => $order->customer_phone,
                ],
                "notes"             => [
                    "address"           => $order->biling_address_1,
                    "merchant_order_id" => $item_number,
                ],
                "theme"             => [
                    "color"             => "#eee"
                ],
                "order_id"          => $razorpayOrderId,
            ];
            if ($this->displayCurrency !== 'INR') {
                $data['display_currency']  = $this->displayCurrency;
                $data['display_amount']    = $displayAmount;
            }

            $json = json_encode($data);
            $displayCurrency = $this->displayCurrency;
            return view('front.payment.razorpay', compact('data', 'displayCurrency', 'json', 'notify_url'));
        } else if ($request->payment_method == 'Stripe') {
            $order->update([
                "payment_method" => "stripe"
            ]);
            Stripe\Stripe::setApiKey($this->stripe_secret);
            $stripe = Stripe\Charge::create([
                "amount" => $total,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
            ]);
            $response = Stripe\Charge::retrieve(
                $stripe->id,
                []
            );
            if ($response->paid) {
                $order->update([
                    "payment_status" => 1
                ]);
                $affiliateService = new AffiliateService();
                $affiliateService->payToAffiliator($order->id);
                ModelTransaction::create([
                    "order_id" => $order->id,
                    "payment_method" => "Stripe",
                    "transaction_id" => $stripe->id
                ]);
                $order->tracks()->create([
                    "title" => "Payment Complete",
                    "details" => "Order payment completed via stripe ",
                ]);

                return redirect()->route('order.success');
            } else {
                return back()->with('error', 'Payment failed');
            }
        } else if ($request->payment_method == 'Paypal') {
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_list = new ItemList();
            $item_list->setItems([]);

            $amount = new Amount();
            $amount->setCurrency($curr->name)
                ->setTotal($total);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Enter Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('paypal.success'))
                ->setCancelUrl(URL::route('paypal.cancel'));

            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    \Session::put('error', 'Connection timeout');
                    return Redirect::route('paywithpaypal');
                } else {
                    \Session::put('error', 'Some error occur, sorry for inconvenient');
                    return Redirect::route('paywithpaypal');
                }
            }

            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
            Session::put('paypal_payment_id', $payment->getId());
            if (isset($redirect_url)) {
                return Redirect::away($redirect_url);
            }
            Session::put('error', 'Unknown error occurred');
        } else {
            return redirect()->route('order.success');
        }
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
