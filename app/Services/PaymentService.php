<?php
namespace App\Services;

use App\Model\Order;
use DataTables;
use Illuminate\Support\Facades\URL;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
class PaymentService
{
    public function __construct()
    {
        
       
        $this->keyId = "rzp_test_bM29R74GNApbEh";
        $this->keySecret ="Jc7g6R97EJAoWEb17SZpMaQU";
        $this->displayCurrency = 'INR';

        $this->api = new Api($this->keyId, $this->keySecret);
    }
    public  function payWithRazorPay($orderId,$total){
        $success_url = action('Payment\PaymentController@payreturn');
        $notify_url = action('Payment\RazorPayController@razorCallback');
        $item_number = Str::random(4).time();
       
        $orderData = [
            'receipt'         => $item_number,
            'amount'          => $total , // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];
        
        $razorpayOrder = $this->api->order->create($orderData);
        
        $razorpayOrderId = $razorpayOrder['id'];
        
        session(['razorpay_order_id'=> $razorpayOrderId]);

        $order=Order::find($orderId);
        $order->update([
            "payment_method"=>"Razorpay"
        ]);

        $displayAmount = $amount = $orderData['amount'];
                    
        if ($this->displayCurrency !== 'INR')
        {
            $url = "https://api.fixer.io/latest?symbols=$this->displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);
        
            $displayAmount = $exchange['rates'][$this->displayCurrency] * $amount / 100;
        }
        $item_name="Order";
        $checkout = 'automatic';
        $data = [
            "key"               => $this->keyId,
            "amount"            => $amount,
            "name"              => $item_name,
            "description"       => $item_name,
            "prefill"           => [
                "name"              => $order->customer_first_name,
                "email"             => $order->customer_email,
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

        
        if ($this->displayCurrency !== 'INR')
        {
            $data['display_currency']  = $this->displayCurrency;
            $data['display_amount']    = $displayAmount;
        }
        
        $json = json_encode($data);
        $displayCurrency = $this->displayCurrency;
        
return view( 'front.payment.razorpay', compact( 'data','displayCurrency','json','notify_url' ) );
    }

}