<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Language;
use App\Model\Setting;
use App\Services\Country;
use Illuminate\Http\Request;
use App\Model\NotificationSetting;
use App\Services\LanguageService;


class GeneralSettingController extends Controller
{
    // site setting
    public function siteSetting()
    {
        $setting = Setting::first();
        $countries = Country::list();
        $supportedCountries = json_decode($setting->supported_countries);
        $languages = Language::all();
        return view('admin.general-setting.site-setting', compact('setting', 'countries', 'supportedCountries', 'languages'));
    }
    public function siteSettingUpdate(Request $request)
    {
        $setting = Setting::first();
        $languages = Language::all();
        foreach ($languages as $language) {
            $language->update([
                "is_default" => 0
            ]);
        }
        $language = Language::find($request->default_locale);
        $language->update([
            "is_default" => 1
        ]);
        $setting->update([
            "title" => $request->title,
            "supported_countries" => json_encode($request->supported_countries),
            "theme_color" => $request->theme_color,
            "default_country" => $request->default_country,
            "contact" => $request->contact,
            "mail" => $request->mail,
            "address" => $request->address,
            "copyright_text" => $request->copyright_text,
            "default_locale" => $request->default_locale,
            "default_timezone" => $request->default_timezone,
            "is_newsletter" => $request->is_newsletter ? 1 : 0,
            "is_cookie" => $request->is_cookie ? 1 : 0,
            "guest_checkout" => $request->guest_checkout ? 1 : 0,
            "email_verification" => $request->email_verification ? 1 : 0,
            "is_captcha" => $request->is_captcha ? 1 : 0,
            "auto_approval_review" => $request->auto_approval_review ? 1 : 0,
            "affiliate_withdraw" => $request->affiliate_withdraw ? 1 : 0,
            "affiliate_shopping" => $request->affiliate_shopping ? 1 : 0,
            "use_bundle" => $request->use_bundle ? 1 : 0,


        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }
    public function logo()
    {
        $setting = Setting::first();
        return view('admin.general-setting.logo', compact('setting'));
    }
    public function updateLogo(Request $request)
    {

        $setting = Setting::first();
        $setting->update([
            "favicon" => $request->favicon,
            "header_logo" => $request->header_logo,
            "mail_logo" => $request->mail_logo,
            "invoice_logo" => $request->invoice_logo,
            "admin_logo" => $request->admin_logo,
            "site_loader" => $request->site_loader,
            "admin_loader" => $request->site_loader,

        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }

    public function socialLink()
    {
        $setting = Setting::first();
        return view('admin.general-setting.social-link', compact('setting'));
    }
    public function socialLinkUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            "facebook_link" => $request->facebook_link,
            "youtube_link" => $request->youtube_link,
            "instagram_link" => $request->instagram_link,
            "skype_link" => $request->skype_link,
            "pinterest_link" => $request->pinterest_link,

        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }
    public function customCssJs()
    {
        $setting = Setting::first();
        return view('admin.general-setting.custom-css-js', compact('setting'));
    }
    public function customCssJsUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            "custom_css" => $request->custom_css,
            "custom_js" => $request->custom_js,
        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }
    public function maintenance()
    {
        $setting = Setting::first();
        return view('admin.general-setting.maintenance', compact('setting'));
    }
    public function maintenanceUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            "is_maintenance" => $request->is_maintenance ? 1 : 0,
            "maintenance_text" => $request->maintenance_text,
        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }
    // seo & plugin
    public function plugin()
    {
        $setting = Setting::first();
        return view('admin.general-setting.plugin', compact('setting'));
    }
    public function pluginUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            "is_messenger" => $request->is_messenger ? 1 : 0,
            "messenger" => $request->messenger,
            "is_tawk_to" => $request->is_tawk_to ? 1 : 0,
            "tawk_to" => $request->tawk_to,
            "is_pixel" => $request->is_pixel ? 1 : 0,
            "facebook_pixel" => $request->facebook_pixel,
            "is_analytic" => $request->is_analytic ? 1 : 0,
            "google_analytic" => $request->google_analytic,
        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }

    public function seo()
    {
        $setting = Setting::first();
        return view('admin.general-setting.seo', compact('setting'));
    }
    public function seoUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            "meta_title"=>$request->meta_title,
            "meta_description"=>$request->meta_description
        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }

    // services
    public function services()
    {
        $setting = Setting::first();

        return view('admin.general-setting.services', compact('setting'));
    }
    public function updateServices(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            "service1_title" => $request->service1_title,
            "service1_sub_title" => $request->service1_sub_title,
            "service2_sub_title" => $request->service2_sub_title,
            "service3_sub_title" => $request->service3_sub_title,
            "service4_sub_title" => $request->service4_sub_title,
            "service1_image" => $request->service1_image,
            "service2_title" => $request->service2_title,
            "service2_image" => $request->service2_image,
            "service3_title" => $request->service3_title,
            "service3_image" => $request->service3_image,
            "service4_title" => $request->service4_title,
            "service4_image" => $request->service4_image
        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }
    // errorbanner
    public function errorBanner()
    {
        $setting = Setting::first();
        return view('admin.general-setting.error404', compact('setting'));
    }
    public function errorBannerUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            "banner_404" => $request->banner_404
        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }
        // paymentImage
        public function paymentImage()
        {
            $setting = Setting::first();
            return view('admin.general-setting.paymentImage', compact('setting'));
        }
        public function paymentImageUpdate(Request $request)
        {
            $setting = Setting::first();
            $setting->update([
                "payment_image" => $request->payment_image
            ]);
            return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
        }
    // popupwindow
    public function popUpWindow()
    {
        $setting = Setting::first();
        return view('admin.general-setting.popup-window', compact("setting"));
    }
    public function popUpWindowUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            "news_letter_title" => $request->news_letter_title,
            "news_letter_sub_title" => $request->news_letter_sub_title,
            "cookie_message" => $request->cookie_message,
            "cookie_button" => $request->cookie_button,
            "news_letter_image"=>$request->news_letter_image
        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }

    // static page
    public function contactSetting()
    {
        $setting = Setting::first();
        return view('admin.general-setting.static-page.contact', compact('setting'));
    }
    public function contactSettingUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            "address2" => $request->address2,
            "mail1" => $request->mail1,
            "mail2" => $request->mail2,
            "phone1" => $request->phone1,
            "phone2" => $request->phone2,
            "is_map" => $request->is_map ? 1 : 0,
            "lat" => $request->lat,
            "lon" => $request->lon,

        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }
    public function aboutSetting()
    {
        $setting = Setting::first();
        return view('admin.general-setting.static-page.about', compact('setting'));
    }
    public function aboutSettingUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            "about_title" => $request->about_title,
            "about_description" => $request->about_description,
        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }
    public function termsSetting()
    {
        $setting = Setting::first();
        return view('admin.general-setting.static-page.terms', compact('setting'));
    }
    public function termsSettingUpdate(Request $request)
    {
        $setting = Setting::first();
        $setting->update([
            "term_title" => $request->term_title,
            "term_description" => $request->term_description,
        ]);
        return back()->with('success', LanguageService::getTranslate('SettingUpdatedSuccessfully'));
    }
    // notification
    public function notification(){
        $notificationSetting=NotificationSetting::first();
        return view('admin.general-setting.notification',compact('notificationSetting'));
    }
    public function notificationUpdate($key,$val){
        $notificationSetting=NotificationSetting::first();
        $notificationSetting->update([
            $key=>$val
        ]);
        return LanguageService::getTranslate("NotificationSettingUpdatedSuccessfully");
    }
}
