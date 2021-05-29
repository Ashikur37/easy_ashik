<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentGatewayAdditional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateway_additionals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_gateway_id')->unsigned();
            $table->foreign('payment_gateway_id')->references('id')->on('payment_gateways')->onDelete('cascade');
            $table->string("title");
            $table->longText("details")->nullable();
            $table->integer('required')->default(0);
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
        Schema::dropIfExists('payment_gateway_additionals');
    }
}
