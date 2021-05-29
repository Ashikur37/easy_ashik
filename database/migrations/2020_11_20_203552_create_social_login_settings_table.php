<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialLoginSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('social_login_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_facebook');
            $table->boolean('is_google');
            $table->string('facebook_client_id');
            $table->string('facebook_client_secret');
            $table->string('google_client_id');
            $table->string('google_client_secret');

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
        Schema::dropIfExists('social_login_settings');
    }
}
