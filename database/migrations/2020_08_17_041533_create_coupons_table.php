<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('is_percent')->default(1);
            $table->integer('active')->default(1);
            $table->integer('amount');
            $table->integer('limit')->default(-1);
            $table->double('min')->nullable();
            $table->double('max')->nullable();
            $table->integer('times')->default(0);
            $table->integer('used')->default(0);
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->integer('all_product');
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
        Schema::dropIfExists('coupons');
    }
}
