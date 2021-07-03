<?php

namespace App\Providers;

use App\Model\Category;
use App\Model\Currency;
use App\Model\EmailSetting;
use App\Model\FlashSale;
use App\Model\FlashSaleProduct;
use App\Model\Product;
use App\Model\WishList;
use App\Model\Key;
use App\Model\Language;
use App\Model\Page;
use App\Model\Setting;
use App\Model\PaymentSetting;
use Config;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Cache;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $flashSaleProducts = [];
        if (!Cache::has('flashSaleProducts')) {
            $flashSale = FlashSale::where('is_active', 1)->where('end', '>', today())->with(['products', 'flashProducts'])->orderBy('id', 'desc')->first();
            if ($flashSale) {
                $flashSaleProducts = FlashSaleProduct::where('flash_sale_id', $flashSale->id)->pluck('product_id')->toArray();
            }
            Cache::put('flashSale', $flashSale, now()->addMinutes(10));
            Cache::put('flashSaleProducts', $flashSaleProducts, now()->addMinutes(10));
        }
        if (!Session::has('currency')) {
            $curr = Currency::where('is_default', '=', 1)->first();
            Session::put('currency', $curr);
        }
        view()->share('setting', Setting::first());

        view()->share('showPages', Page::whereActive(1)->get(['name', 'slug']));
        view()->share('currencies', Currency::orderBy('is_default', 'desc')->get());
        view()->share('topProducts', Product::orderBy('viewed', 'desc')->limit(5)->get());
        view()->share('topKeys', Key::orderBy('hits', 'desc')->limit(5)->get());
        view()->share('categories', Category::whereStatus(1)->with(['subCategories' => function ($q) {
            $q->whereStatus(1)->with(['childCategories' => function ($q) {
                $q->whereStatus(1);
            }]);
        }])->take(10)->get());
        view()->share('langs', Language::whereIsActive(1)->get());
        view()->composer('*', function ($settings) {

            $wishCount = 0;
            $wishProducts = [];
            if (auth()->check()) {
                if (!Session::has('wishCount')) {
                    Session::put('wishCount', WishList::where('user_id', auth()->user()->id)->count());
                    Session::put('wishProducts', WishList::where('user_id', auth()->user()->id)->pluck('product_id')->toArray());
                }
                $wishCount = Session::get('wishCount');
                $wishProducts = Session::get('wishProducts');
            }
            $settings->with('wishCount', $wishCount);
            $settings->with('wishProducts', $wishProducts);
        });
        view()->composer('*', function ($settings) {

            if (!Session::has('currency')) {
                $curr = Currency::where('is_default', '=', 1)->first();
                Session::put('currency', $curr);
            }

            if (!Cache::has('paymentSetting')) {
                Cache::put('paymentSetting', PaymentSetting::first());
            }

            if (Session::has('language')) {
                $data = Session::get('language');
                if (file_exists(public_path() . '/assets/lang/' . $data->file)) {
                    $data_results = file_get_contents(public_path() . '/assets/lang/' . $data->file);
                } else {
                    $data = DB::table('languages')->where('is_default', '=', 1)->first();
                    Session::put('language', $data);
                    $data_results = file_get_contents(public_path() . '/assets/lang/' . $data->file);
                }
                $lang = json_decode($data_results);
                view()->share('lng', $lang);
            } else {
                $data = DB::table('languages')->where('is_default', '=', 1)->first();
                Session::put('language', $data);
                $data_results = file_get_contents(public_path() . '/assets/lang/' . $data->file);
                $lang = json_decode($data_results);
                view()->share('lng', $lang);
            }
        });
        $es = EmailSetting::first();
        $config = array(
            'driver'     => 'smtp',
            'host'       => $es->smtp_host,
            'port'       => $es->smtp_port,
            'from'       => array('address' => $es->from_email, 'name' => $es->from_name),
            'encryption' => $es->mail_encryption,
            'username'   => $es->smtp_user,
            'password'   => $es->smtp_pass,
            'sendmail'   => '/usr/sbin/sendmail -bs',
            'pretend'    => false,
        );
        Config::set('mail', $config);
        $setting = Setting::first();
        Config::set('app.timezone', $setting->default_timezone);
    }
}
