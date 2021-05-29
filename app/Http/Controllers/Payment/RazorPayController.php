<?php
  
namespace App\Http\Controllers\Payment;
  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Transaction;
use App\Services\AffiliateService;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\ExpressCheckout;
use Razorpay\Api\Api;
class RazorPayController extends Controller
{
    public function __construct()
    {
        
       
        $this->keyId = "rzp_test_bM29R74GNApbEh";
        $this->keySecret ="Jc7g6R97EJAoWEb17SZpMaQU";
        $this->displayCurrency = 'INR';

        $this->api = new Api($this->keyId, $this->keySecret);
    }
    public function razorCallback( Request $request ) {


        $success = true;

        $error = "Payment Failed";
        
        if (empty($_POST['razorpay_payment_id']) === false)
        {
            //$api = new Api($keyId, $keySecret);
        
            try
            {
                // Please note that the razorpay order ID must
                // come from a trusted source (session here, but
                // could be database or something else)
                $attributes = array(
                    'razorpay_order_id' => session('razorpay_order_id'),
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature']
                );
        
                $this->api->utility->verifyPaymentSignature($attributes);
            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }
        
        if ($success === true)
        {
            
            $razorpayOrder = $this->api->order->fetch(session('razorpay_order_id'));
        
            $order_id = $razorpayOrder['receipt'];
            
            $transaction_id = $_POST['razorpay_payment_id'];
            $order = Order::where( 'order_number', $order_id )->first();

            $order->update([
                "payment_status"=>1
            ]);
            $affiliateService=new AffiliateService();
            $affiliateService->payToAffiliator($order->id);
            Transaction::create([
                "order_id"=>$order->id,
                "payment_method"=>"Razorpay",
                "transaction_id"=>$transaction_id
            ]);
            $order->tracks()->create([
                "title"=>"Payment Complete",
                "details"=>"Order payment completed via Razorpay ",
            ]);
            return redirect()->route('order.success');

        }
        else
        {
            
            return redirect(route('front.checkout'));
        }
        
    }

}