<?php
  
namespace App\Http\Controllers\Payment;
  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Transaction;
use App\Services\AffiliateService;
use App\Services\LanguageService;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    private $_api_context;
    public function __construct()
    {
        
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $payment = Payment::get(Session::get('paypal_payment_id'), $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /**Execute the payment **/
        $response = $payment->execute($execution, $this->_api_context);
        if ($response->getState() == 'approved') {
            $order=Order::find(Session::get('order_id'));
            $order->update([
                "payment_status"=>1
            ]);
            $affiliateService=new AffiliateService();
            $affiliateService->payToAffiliator($order->id);
            $order->tracks()->create([
                "title"=>LanguageService::getTranslate('PaymentComplete'),
                "details"=>LanguageService::getTranslate("OrderPaymentCompletedVPaypal"),
            ]);
            return redirect()->route('order.success');
        }
    }

}