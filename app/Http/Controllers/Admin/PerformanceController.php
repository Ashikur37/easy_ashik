<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\PaymentSetting;
use App\Services\LanguageService;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PerformanceController extends Controller
{
    public function clearCache()
    {
        Artisan::call('cache:clear');
        return redirect()->back()->with('success', LanguageService::getTranslate('CacheClearedSuccessfully'));
    }
    public function cache()
    {
        Artisan::call('config:cache');
        return redirect()->back()->with('success', LanguageService::getTranslate('CachedSuccessfully'));
    }
    public function optimize()
    {
        $url = URL::to('/admin');
        Artisan::call('optimize');
        Artisan::call('route:clear');
        return redirect($url)->with('success', LanguageService::getTranslate('OptimizedSuccessfully'));
    }
}
