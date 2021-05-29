<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if(auth()->user()){
            if(auth()->user()&&auth()->user()->type == 3&&auth()->user()->can($request->route()->getName())){
                return $next($request);
            }
        }
        
       
        return redirect('/admin/login')->with('',"You don't have admin access.");
    }
}
