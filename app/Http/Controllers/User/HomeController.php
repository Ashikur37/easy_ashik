<?php  
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Model\Order;

class HomeController extends Controller
{

    public function index(){
        $orders=Order::where('customer_id',auth()->user()->id)->latest()->take(5)->get();
        return view('user.home.index',compact('orders'));
    }
}