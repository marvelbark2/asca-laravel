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
            if(Auth::user()->type == 'super_admin'){
                return redirect('/admin/taches');
            }
            elseif(Auth::user()->type == 'pending'){
                return redirect('/pending');
            }
            else{
                return redirect('/tache');
            }

        }

        return $next($request);
    }
}
