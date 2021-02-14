<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class SuperAdmin
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
        if ($request->user() && $request->user()->type != 'super_admin' && $request->user()->type == 'pending')
        {
        return new Response(abort(404));
        }
        return $next($request);
    }
}
