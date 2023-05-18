<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

       if(!empty(Auth::user())){
        // Not login and register again if the user is already done.
        if(url()->current() == route('loginPage') || url()->current() == route('registerPage')){
            return back();
        }
        // Can not enter if the role tis user
        if(Auth::user()->role == 'user'){
            return back();
        }
        // Can continue to work if the role is admin
        return $next($request);
       }
        // Can login and register 
        return $next($request);
    }
}
