<?php  
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Model\Blog;
use App\Model\Brand;
use App\Model\FlashSale;
use App\Model\Order;
use App\Model\Product;
use App\Model\Slide;
use Illuminate\Support\Facades\Session;
use App\Services\Notification;
class OrderController extends Controller
{
    public function success(){
        if(!Session::has('order_id')){
            return back();
        }
        $id=Session::get('order_id');
        $order=Order::find($id);
        if(!$order){
            return redirect('/');
        }
        $items = unserialize(bzdecompress(utf8_decode($order->cart)));
        //Notification::
        Notification::newOrderNotificationAdmin($order->id);
        Notification::newOrderNotificationUser($order->id);
        return view('user.order.success',compact('order','items'));
    }
}