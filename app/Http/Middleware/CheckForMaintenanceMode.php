<?php

namespace App\Http\Middleware;

use App\Model\Setting;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use Closure;
 
class CheckForMaintenanceMode extends Middleware
{
    public function handle($request, Closure $next)
    {
        // if(count(explode('easymert',request()->root()))==1){
        //     dd("PLease verify purchase");
        // }
        // if(!file_exists(storage_path('installed'))){
        //     // if(!file_exists(storage_path('purchased'))){
        //     //     if(count(explode('verify-purchase',request()->url()))==1){

        //     //         return redirect('/verify-purchase');
        //     //     }
        //     // }
        //     if(count(explode('install',request()->url()))==1){
        //         return redirect('/install');
        //     }
        //     return $next($request);
        // }
        
        $setting=Setting::first();
        if($setting->is_maintenance){
           if(count(explode('ckeditor',request()->url()))>1||count(explode('admin',request()->url()))>1||count(explode('maintenance',request()->url()))>1||count(explode('contact',request()->url()))>1||count(explode('login',request()->url()))>1){
               //contact/submit
            return $next($request);
           }
           return redirect()->route('maintenance');
        }
        return $next($request);
    }
}
