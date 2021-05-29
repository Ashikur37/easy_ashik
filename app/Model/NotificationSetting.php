<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    protected $fillable=[
        'admin_db_new_user',
        'admin_db_new_order',
        'admin_db_product_comment',
        'admin_db_product_review',
        'admin_db_product_comment_reply',
        'admin_db_blog_comment_reply',
        'admin_db_new_ticket',
        'admin_db_ticket_reply',
        'admin_db_withdraw',
        'admin_db_blog_comment',
        'admin_db_contact_form',
        'admin_mail_new_user',
        'admin_mail_new_order',
        'admin_mail_product_comment',
        'admin_mail_product_review',
        'admin_mail_product_comment_reply',
        'admin_mail_blog_comment_reply',
        'admin_mail_new_ticket',
        'admin_mail_ticket_reply',
        'admin_mail_withdraw',
        'admin_mail_blog_comment',
        'admin_mail_contact_form',
        'user_db_product_comment_reply',
        'user_db_blog_comment_reply',
        'user_db_ticket_reply',
        'user_db_order_success',
        'user_db_order_update',
        'user_db_withdraw_update',
        'user_db_balance_update',
        'user_mail_product_comment_reply',
        'user_mail_blog_comment_reply',
        'user_mail_ticket_reply',
        'user_mail_order_success',
        'user_mail_order_update',
        'user_mail_withdraw_update',
        'user_mail_balance_update',

    ];
}
