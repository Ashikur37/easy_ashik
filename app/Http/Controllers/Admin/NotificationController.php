<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;


class NotificationController extends Controller
{

    public function index(){
        $notifications=auth()->user()->notifications->paginate(10);
        return view('admin.notification.index',compact('notifications'));
    }
}