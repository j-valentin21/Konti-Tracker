<?php

namespace App\Http\Middleware;

use Closure;

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;
use Sentry\State\Scope;

class SentryUserContext
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && app()->bound('sentry'))
        {
            \Sentry\configureScope(function (Scope $scope): void {
                $scope->setUser([
                    'id'    => Auth::user()->id,
                    'email' => Auth::user()->email,
                    'name'  => Auth::user()->name,
                ]);
            });
        }

        return $next($request);
    }
}
