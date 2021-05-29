<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;


class NotificationController extends Controller
{

    public function index(){
        $notifications=auth()->user()->notifications->paginate(10);
        return view('user.notification.index',compact('notifications'));
    }
   
}