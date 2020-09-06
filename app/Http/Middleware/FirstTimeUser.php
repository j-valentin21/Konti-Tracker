<?php

namespace App\Http\Middleware;

use Closure;

class FirstTimeUser
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
        if(auth()->user()->firstTimeUser == 1){
            return $next($request);
        }
        return redirect('/dashboard');
    }
}
