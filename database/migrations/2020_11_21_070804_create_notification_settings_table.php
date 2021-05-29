<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id(); 
            $table->boolean('admin_db_new_user');
            $table->boolean('admin_db_new_order');
            $table->boolean('admin_db_product_comment');
            $table->boolean('admin_db_product_review');
            $table->boolean('admin_db_product_comment_reply');
            $table->boolean('admin_db_blog_comment_reply');
            $table->boolean('admin_db_new_ticket');
            $table->boolean('admin_db_ticket_reply');
            $table->boolean('admin_db_withdraw');
            $table->boolean('admin_db_blog_comment');
            $table->boolean('admin_db_contact_form');
            $table->boolean('admin_mail_new_user');
            $table->boolean('admin_mail_new_order');
            $table->boolean('admin_mail_product_comment');
            $table->boolean('admin_mail_product_review');
            $table->boolean('admin_mail_product_comment_reply');
            $table->boolean('admin_mail_blog_comment_reply');
            $table->boolean('admin_mail_new_ticket');
            $table->boolean('admin_mail_ticket_reply');
            $table->boolean('admin_mail_withdraw');
            $table->boolean('admin_mail_blog_comment');
            $table->boolean('admin_mail_contact_form');
            $table->boolean('user_db_product_comment_reply');
            $table->boolean('user_db_blog_comment_reply');
            $table->boolean('user_db_ticket_reply');
            $table->boolean('user_db_order_success');
            $table->boolean('user_db_order_update');
            $table->boolean('user_db_withdraw_update');
            $table->boolean('user_db_balance_update');
            $table->boolean('user_mail_product_comment_reply');
            $table->boolean('user_mail_blog_comment_reply');
            $table->boolean('user_mail_ticket_reply');
            $table->boolean('user_mail_order_success');
            $table->boolean('user_mail_order_update');
            $table->boolean('user_mail_withdraw_update');
            $table->boolean('user_mail_balance_update');

 
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
        Schema::dropIfExists('notification_settings');
    }
}
