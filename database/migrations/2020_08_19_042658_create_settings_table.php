<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
            $table->text("supported_countries")->nullable();
            $table->string("theme_color")->nullable();
            $table->string("default_country")->nullable();
            $table->string("contact")->nullable();
            $table->string("mail")->nullable();
            $table->string("address")->nullable();
            $table->string("copyright_text")->nullable();
            $table->string("default_locale")->nullable();
            $table->string("default_timezone")->nullable();
            $table->integer("is_newsletter")->nullable();
            $table->integer("is_cookie")->nullable();
            $table->integer("guest_checkout")->nullable();
            $table->integer("email_verification")->nullable();
            $table->integer("is_captcha")->nullable();
            $table->integer("is_best_deal")->nullable();
            $table->integer("auto_approval_review")->nullable();
            $table->string("favicon")->nullable();
            $table->string("header_logo")->nullable();
            $table->string("footer_logo")->nullable();
            $table->string("mail_logo")->nullable();
            $table->string("invoice_logo")->nullable();
            $table->string("admin_logo")->nullable();
            $table->string("site_loader")->nullable();
            $table->string("admin_loader")->nullable();
            $table->string("facebook_link")->nullable();
            $table->string("youtube_link")->nullable();
            $table->string("instagram_link")->nullable();
            $table->string("skype_link")->nullable();
            $table->string("pinterest_link")->nullable();
            $table->integer("is_maintenance")->nullable();
            $table->longText("maintenance_text")->nullable();
            $table->string("service1_title")->nullable();
            $table->string("service1_image")->nullable();
            $table->string("service2_title")->nullable();
            $table->string("service2_image")->nullable();
            $table->string("service3_title")->nullable();
            $table->string("service3_image")->nullable();
            $table->string("service4_title")->nullable();
            $table->string("service4_image")->nullable();
            $table->string("banner_404")->nullable();
            $table->string("news_letter_title")->nullable();
            $table->string("news_letter_sub_title")->nullable();
            $table->string("cookie_message")->nullable();
            $table->string("cookie_button")->nullable();
            $table->text("custom_css")->nullable();
            $table->text("custom_js")->nullable();
            $table->integer("is_messenger")->nullable();
            $table->text("messenger")->nullable();
            $table->integer("is_tawk_to")->nullable();
            $table->text("tawk_to")->nullable();
            $table->integer("is_pixel")->nullable();
            $table->text("facebook_pixel")->nullable();
            $table->integer("is_analytic")->nullable();
            $table->text("google_analytic")->nullable();

            $table->integer("is_top_right_banner_1")->nullable();
            $table->integer("is_top_right_banner_2")->nullable();
            $table->string("top_right_banner_1_image")->nullable();
            $table->string("top_right_banner_2_image")->nullable();
            $table->string("top_right_banner_1_text")->nullable();
            $table->string("top_right_banner_1_url")->nullable();
            $table->integer("top_right_banner_1_new_window")->nullable();
            $table->string("top_right_banner_2_text")->nullable();
            $table->string("top_right_banner_2_url")->nullable();

            $table->integer("is_two_column_banner_1")->nullable();
            $table->integer("is_two_column_banner_2")->nullable();
            $table->string("two_column_banner_1_image")->nullable();
            $table->string("two_column_banner_1_url")->nullable();
            $table->integer("two_column_banner_1_new_window")->nullable();
            $table->string("two_column_banner_2_image")->nullable();
            $table->string("two_column_banner_2_url")->nullable();
            $table->integer("two_column_banner_2_new_window")->nullable();
            $table->string("two_column_banner_3_image")->nullable();
            $table->string("two_column_banner_3_url")->nullable();
            $table->integer("two_column_banner_3_new_window")->nullable();

            $table->integer("top_right_banner_2_new_window")->nullable();
            $table->integer("is_best_deal_banner_1")->nullable();
            $table->integer("is_best_deal_banner_2")->nullable();
            $table->string("best_deal_banner_1_image")->nullable();
            $table->string("best_deal_banner_2_image")->nullable();
            $table->string("best_deal_banner_1_url")->nullable();
            $table->integer("best_deal_banner_1_new_window")->nullable();
            $table->string("best_deal_banner_2_url")->nullable();
            $table->integer("best_deal_banner_2_new_window")->nullable();
            $table->string("is_full_width_banner")->nullable();
            $table->string("full_width_banner_image")->nullable();
            $table->string("full_width_banner_url")->nullable();
            $table->string("full_width_banner_new_window")->nullable();
            $table->string("is_slider")->nullable();
            $table->integer("is_brands")->nullable();
            $table->integer("is_flash_deal")->nullable();
            $table->integer("is_blog")->nullable();
            $table->string("is_best_sale")->nullable();
            $table->integer("is_service")->nullable();
            $table->integer("top_in_category")->nullable();
            $table->integer("is_three_column_product")->nullable();
            $table->string("address2")->nullable();
            $table->text("mail1")->nullable();
            $table->text("mail2")->nullable();
            $table->string("phone1")->nullable();
            $table->string("phone2")->nullable();
            $table->integer("is_map")->nullable();
            $table->string("lat")->nullable();
            $table->string("lon")->nullable();
            $table->string("about_title")->nullable();
            $table->longText("about_description")->nullable();
            $table->string("term_title")->nullable();
            $table->longText("term_description")->nullable();
            $table->boolean('affiliate_withdraw');
            $table->boolean('affiliate_shopping');
            $table->double('global_affiliate_percent');
            $table->text("meta_title")->nullable();
            $table->text("meta_description")->nullable();
            $table->text("news_letter_image")->nullable();
            $table->integer("is_new_arrival");
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
        Schema::dropIfExists('settings');
    }
}
