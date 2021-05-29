<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('name');
            $table->longText('details')->nullable();
            $table->integer('brand_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->integer('child_category_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('image');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->decimal('price', 18, 2)->unsigned();
            $table->decimal('special_price', 18, 2)->unsigned()->nullable();
            $table->date('special_price_start')->nullable();
            $table->date('special_price_end')->nullable();
            $table->string('price_type');
            $table->string('special_price_type');
            $table->decimal('selling_price', 18, 2)->unsigned()->nullable();
            $table->string('sku')->nullable();
            $table->boolean('manage_stock');
            $table->integer('qty')->nullable();
            $table->boolean('in_stock');
            $table->integer('viewed')->unsigned()->default(0);
            $table->boolean('is_active');
            $table->boolean('is_trending')->default(0);
            $table->boolean('is_hot')->default(0);
            $table->boolean('is_top')->default(0);
            $table->boolean('best_deal')->default(0);
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
        Schema::dropIfExists('products');
    }
}
