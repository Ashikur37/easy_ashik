<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number');
            $table->integer('customer_id')->nullable()->index();
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->string('customer_first_name');
            $table->string('customer_last_name');
            $table->string('billing_first_name');
            $table->string('billing_last_name');
            $table->string('billing_address_1');
            $table->string('billing_address_2')->nullable();
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_zip');
            $table->string('billing_country');
            $table->string('shipping_first_name');
            $table->string('shipping_last_name');
            $table->string('shipping_address_1');
            $table->string('shipping_address_2')->nullable();
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_zip');
            $table->string('shipping_country');
            $table->decimal('sub_total', 18, 2)->unsigned();
            $table->string('shipping_method');
            $table->decimal('shipping_cost', 18, 2)->unsigned();
            $table->integer('coupon_id')->nullable()->index();
            $table->decimal('discount', 18, 2)->unsigned();
            $table->decimal('total', 18, 2)->unsigned();
            $table->decimal('tax', 18, 2)->unsigned();
            $table->string('payment_method');
            $table->string('currency');
            $table->decimal('currency_rate', 18, 2);
            $table->string('locale');
            $table->string('status');
            $table->integer('payment_status')->default(0);
            $table->text('cart');
            $table->text('note')->nullable();
            $table->integer('affiliator')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
