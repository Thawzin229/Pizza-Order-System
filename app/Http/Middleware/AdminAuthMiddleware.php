<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(Auth::user())){

            if(url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage')){
                return redirect()->route('admin#categorylist')->with(["permissiontologin" => "you have already logged in"]);
            }

            if(Auth::user()->role == "user"){
                return redirect()->route('user#home')->with(["permission" => "you have no permission to enter admin session"]);
            }
            return $next($request);
        }
        return $next($request);
 
    }
}
