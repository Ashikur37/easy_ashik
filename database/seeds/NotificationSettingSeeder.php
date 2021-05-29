<?php

use Illuminate\Database\Seeder;

class NotificationSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notification_settings')->insert([
            'admin_db_new_user'=>1,
            'admin_db_new_order'=>1,
            'admin_db_product_comment'=>1,
            'admin_db_product_review'=>1,
            'admin_db_product_comment_reply'=>1,
            'admin_db_blog_comment_reply'=>1,
            'admin_db_new_ticket'=>1,
            'admin_db_ticket_reply'=>1,
            'admin_db_withdraw'=>1,
            'admin_db_blog_comment'=>1,
            'admin_db_contact_form'=>1,
            'admin_mail_new_user'=>0,
            'admin_mail_new_order'=>0,
            'admin_mail_product_comment'=>0,
            'admin_mail_product_review'=>0,
            'admin_mail_product_comment_reply'=>0,
            'admin_mail_blog_comment_reply'=>0,
            'admin_mail_new_ticket'=>0,
            'admin_mail_ticket_reply'=>0,
            'admin_mail_withdraw'=>0,
            'admin_mail_blog_comment'=>0,
            'admin_mail_contact_form'=>0,
            'user_db_product_comment_reply'=>1,
            'user_db_blog_comment_reply'=>1,
            'user_db_ticket_reply'=>1,
            'user_db_order_success'=>1,
            'user_db_order_update'=>1,
            'user_db_withdraw_update'=>1,
            'user_db_balance_update'=>1,
            'user_mail_product_comment_reply'=>0,
            'user_mail_blog_comment_reply'=>0,
            'user_mail_ticket_reply'=>0,
            'user_mail_order_success'=>0,
            'user_mail_order_update'=>0,
            'user_mail_withdraw_update'=>0,
            'user_mail_balance_update'=>0,
    
        ]);
    }
}
