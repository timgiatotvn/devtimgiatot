<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthMiddleware
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
        if (auth('users')->check() || auth('admins')->check()) {
            return $next($request);
        } else {
            return redirect()->route('client.home');
        }
    }
}
