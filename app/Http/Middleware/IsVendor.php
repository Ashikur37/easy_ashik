<?php

namespace App\Http\Middleware;

use App\Model\Setting;
use Closure;

class IsVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $setting=Setting::first();
        if(auth()->user()&&auth()->user()->is_vendor==1){
            if(!auth()->user()->email_verified_at&&$setting->email_verification){
                return redirect()->route('login')->with('error','Please verify your email');
            }
            return $next($request);
        }
        else if(auth()->user()&&auth()->user()->type==3){
            return redirect('/admin');
        }
       
        return redirect('home')->with('',"You don't have vendor access.");
    }
}
