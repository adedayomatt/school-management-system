<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotSuperAdmin1
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
        if(!Auth::user()->isSuperAdmin() || (Auth::user()->isSuperAdmin() && !Auth::user()->profile->isLevel1()) ){
            return redirect()->back()->with('warning','You are not authorized for that!');
        }

        return $next($request);
    }
}
