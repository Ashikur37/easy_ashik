<?php

use Illuminate\Database\Seeder;

class PaymentSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_settings')->insert([
            'is_paypal'=>0,
            'is_stripe'=>0,
            'is_cod'=>1,
            'is_razor_pay'=>0,
            'paypal_mode'=>'sandbox',
            'paypal_client'=>'',
            'paypal_secret'=>'',
            'stripe_key'=>'',
            'stripe_secret'=>'',
            'razorpay_key'=>'',
            'razorpay_secret'=>'',
            'tax'=>0
        ]);
    }
}
