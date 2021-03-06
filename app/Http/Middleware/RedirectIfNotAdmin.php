<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
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
        if(!Auth::user()->isAdmin()){
            return redirect()->back()->with('warning','You are not authorized for that!, contact any of the administrators to perform that action. <a href="'.route('role.show',[1]).'">click here to see the admins</a>');
        }
        return $next($request);
    }
}
