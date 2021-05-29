<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $fillable=['is_ssl','store_id','store_password','ssl_mode','is_paypal','is_stripe','is_cod','is_razor_pay','paypal_mode','paypal_client','paypal_secret','stripe_key','stripe_secret','razorpay_key','razorpay_secret','tax'];
}
