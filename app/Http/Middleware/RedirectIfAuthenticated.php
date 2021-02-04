<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            
            //role(権限)によって表示ページを振り分け
            $role = Auth::user()->role;
            if($role > 0 && $role <= 5){
                return redirect('/admin');
            }
            else if($role >= 6 && $role <= 10){
                return redirect('/general');
            }
        }

        return $next($request);
    }
}
