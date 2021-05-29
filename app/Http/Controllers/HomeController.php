<?php

namespace App\Http\Controllers;

use App\Model\FlashSale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard. 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       return redirect('/');
    }
    public function adminLogin(){
        return view('admin.login');
    }
    public function readNotification($id){
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
    }
}
