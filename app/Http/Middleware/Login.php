<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        $loginState = session('isLogin');
        $loginTime = session('loginTime');
        $now = time();
        $isOutTime = $now - $loginTime > 6 * 3600;
        if(!$isOutTime && $loginState){
            return $next($request);
        }
        return redirect('login');
    }
}
