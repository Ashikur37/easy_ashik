<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Setting;
use App\Services\LanguageService;
use Illuminate\Http\Request;

class FrontSettingController extends Controller
{
     // banner
     public function topRightBanner(){
         $setting=Setting::first();
        return view('admin.front-setting.banner.top-right-banner',compact('setting'));
    }
    public function topRightBannerUpdate(Request $request){
        $setting=Setting::first();
        $setting->update([
            "top_right_banner_1_image"=>$request->top_right_banner_1_image,
            "top_right_banner_2_image"=>$request->top_right_banner_2_image,
            "top_right_banner_1_text"=>$request->top_right_banner_1_text,
            "top_right_banner_1_url"=>$request->top_right_banner_1_url,
            "top_right_banner_1_new_window"=>$request->top_right_banner_1_new_window?1:0,
            "top_right_banner_2_text"=>$request->top_right_banner_2_text,
            "top_right_banner_2_url"=>$request->top_right_banner_2_url,
            "top_right_banner_2_new_window"=>$request->top_right_banner_2_new_window?1:0,
        ]);
        return back()->with('success',LanguageService::getTranslate('SettingUpdatedSuccessfully'));

    }

         // banner
         public function twoColumnBanner(){
            $setting=Setting::first();
           return view('admin.front-setting.banner.two-column-banner',compact('setting'));
       }
       public function twoColumnBannerUpdate(Request $request){
           $setting=Setting::first();
           $setting->update([
               "two_column_banner_1_image"=>$request->two_column_banner_1_image,
               "two_column_banner_1_url"=>$request->two_column_banner_1_url,
               "two_column_banner_1_new_window"=>$request->two_column_banner_1_new_window?1:0,
               "two_column_banner_2_image"=>$request->two_column_banner_2_image,
               "two_column_banner_2_url"=>$request->two_column_banner_2_url,
               "two_column_banner_2_new_window"=>$request->two_column_banner_2_new_window?1:0,
               "two_column_banner_3_image"=>$request->two_column_banner_3_image,
               "two_column_banner_3_url"=>$request->two_column_banner_3_url,
               "two_column_banner_3_new_window"=>$request->two_column_banner_3_new_window?1:0,
           ]);
           return back()->with('success',LanguageService::getTranslate('SettingUpdatedSuccessfully'));
   
       }

    public function bestDealBanner(){
        $setting=Setting::first();
        return view('admin.front-setting.banner.best-deal-banner',compact('setting'));
    }
    public function bestDealBannerUpdate(Request $request){
        $setting=Setting::first();
        $setting->update([
            "best_deal_banner_1_image"=>$request->best_deal_banner_1_image,
            "best_deal_banner_2_image"=>$request->best_deal_banner_2_image,
            "best_deal_banner_1_url"=>$request->best_deal_banner_1_url,
            "best_deal_banner_1_new_window"=>$request->best_deal_banner_1_new_window?1:0,
            "best_deal_banner_2_url"=>$request->best_deal_banner_2_url,
            "best_deal_banner_2_new_window"=>$request->best_deal_banner_2_new_window?1:0,
        ]);
        return back()->with('success',LanguageService::getTranslate('SettingUpdatedSuccessfully'));

    }

    public function fullWidthBanner(){
        $setting=Setting::first();
        return view('admin.front-setting.banner.full-width-banner',compact('setting'));
    }
    public function fullWidthBannerUpdate(Request $request){
        $setting=Setting::first();
        $setting->update([
            "full_width_banner_image"=>$request->full_width_banner_image,
            "full_width_banner_url"=>$request->full_width_banner_url,
            "full_width_banner_new_window"=>$request->full_width_banner_new_window?1:0,
            "full_width_banner_2_image"=>$request->full_width_banner_2_image,
            "full_width_banner_2_url"=>$request->full_width_banner_2_url,
            "full_width_banner_2_new_window"=>$request->full_width_2_banner_new_window?1:0,
        ]);
        return back()->with('success',LanguageService::getTranslate('SettingUpdatedSuccessfully'));

    }

    // home page option
    public function homePageOption(){
        $setting=Setting::first();
        return view('admin.front-setting.home-page-option',compact('setting'));
    }
    public function homePageOptionUpdate(Request $request){
        $setting=Setting::first();
        $setting->update([
        "is_slider"=>$request->is_slider?1:0,
        "is_brands"=>$request->is_brands?1:0,
        "is_flash_deal"=>$request->is_flash_deal?1:0,
        "is_blog"=>$request->is_blog?1:0,
        "is_best_sale"=>$request->is_best_sale?1:0,
        "is_service"=>$request->is_service?1:0,
        "top_in_category"=>$request->top_in_category?1:0,
        "is_three_column_product"=>$request->is_three_column_product?1:0,
        "is_full_width_banner"=>$request->is_full_width_banner?1:0,
        "is_two_column_banner_1"=>$request->is_two_column_banner_1?1:0,
        "is_new_arrival"=>$request->is_new_arrival?1:0,
        "is_best_deal"=>$request->is_best_deal?1:0,
        ]);
        return back()->with('success',LanguageService::getTranslate('SettingUpdatedSuccessfully'));

    }

    
}
