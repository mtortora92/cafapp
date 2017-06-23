<?php

namespace cafapp\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfLoggedAsSupervisor
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
        if(!Auth::user()->isSupervisor()){
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
