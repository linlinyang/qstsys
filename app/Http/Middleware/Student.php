<?php

namespace App\Http\Middleware;

use Closure;

class Student
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
        
        $guestid = session('guestid');
        $expired = session('expired');
        $now = time();
        if(empty($guestid) || $now > $expired){
            session()->flush();
            return redirect('guest');
        }
        return $next($request);
    }
}
