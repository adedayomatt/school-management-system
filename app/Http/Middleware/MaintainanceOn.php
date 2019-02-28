<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class MaintainanceOn
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
        if(Auth::check() && !Auth::user()->isSuperAdmin()){
            return redirect()->route('maintainance');
        }
        return redirect()->route('maintainance');
        
        return $next($request);
    }
}
