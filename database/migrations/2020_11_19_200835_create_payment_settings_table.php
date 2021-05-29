<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_paypal');
            $table->boolean('is_stripe');
            $table->boolean('is_cod');
            $table->boolean('is_razor_pay');
            $table->string('paypal_mode');
            $table->string('paypal_client');
            $table->string('paypal_secret');
            $table->string('stripe_key');
            $table->string('stripe_secret');
            $table->string('razorpay_key');
            $table->string('razorpay_secret');
            $table->double('tax');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_settings');
    }
}
