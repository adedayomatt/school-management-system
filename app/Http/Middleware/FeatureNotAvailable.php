<?php

namespace App\Http\Middleware;

use Closure;

class FeatureNotAvailable
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
        return redirect()->back()->with('warning','This feature is not currently unavailable');
        return $next($request);
    }
}
