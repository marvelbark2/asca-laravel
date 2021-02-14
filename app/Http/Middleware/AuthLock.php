<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AuthLock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If the user does not have this feature enabled, then just return next.
        if (!$request->user()->hasLockoutTime()) {
            // Check if previous session was set, if so, remove it because we don't need it here.
            if (Session::get('lock-expires-at')) {
                Session::forget('lock-expires-at');
            }

            return $next($request);
        }

        if ($lockExpiresAt = Session::get('lock-expires-at')) {
            if ($lockExpiresAt > now()) {
                return redirect()->route('login.locked');
            }
        }

        session(['lock-expires-at' => now()->addMinutes($request->user()->getLockoutTime())]);

        return $next($request);
    }
}
