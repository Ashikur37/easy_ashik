<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->string('title')->nullable();
            $table->string('button_text')->nullable();
            $table->string('color');
            $table->string('title_color');
            $table->integer('direction');
            $table->text('body')->nullable();
            $table->string('call_to_action_url')->nullable();
            $table->boolean('open_in_new_window')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('slides');
    }
}
