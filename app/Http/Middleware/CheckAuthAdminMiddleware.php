<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthAdminMiddleware
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
        if (auth('admins')->check()) {
            return $next($request);
        } else {
            return response()->json(['success' => "You can not remove"]);
        }
    }
}
