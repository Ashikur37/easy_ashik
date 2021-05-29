<?php
namespace App\Services;

use App\Model\AffiliateProduct;
use App\Model\Order;
use App\Model\Setting;
use App\User;

class AffiliateService{

    public function getProductPercent($productId){
        $setting=Setting::first();
        $affiliateProduct=AffiliateProduct::where('product_id',$productId)->where('status',1)->first();
        if($affiliateProduct){
            return $affiliateProduct->percentage;
        }
        else{
            return $setting->global_affiliate_percent;
        }
    }
    public function payToAffiliator($id){
        $order=Order::find($id);
        
        $user=User::find($order->customer_id);
            if($user&&$order->payment_status==1){
                $user->affiliate_balance+=$order->cashback;
                $user->save();
            }
        if($order->affiliator&&$order->payment_status==1){
            
            $amount=0;
            $items = unserialize(bzdecompress(utf8_decode($order->cart)));
            foreach($items as $item){
                $amount+=$this->getProductPercent($item->id)*0.01*$item->price*$item->qty;
            }
            $user=User::find($order->affiliator);
            $user->affiliate_balance+=$amount;
            $user->save();
            if($amount>0){
                Notification::userAffiliation($user->id,$amount);
            }
        }
    }
}