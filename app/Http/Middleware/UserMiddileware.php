<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class UserMiddileware
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
        if ($request->user() && $request->user()->type == 'pending')
        {
            return redirect()->route('pending');
        }
        return $next($request);
    }
}
