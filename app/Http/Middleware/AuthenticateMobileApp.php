<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateMobileApp
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
        if ($request->header('app-pass') != env('API_MOBILE_APP_PASS')) {
            return response()->json([
                'status' => 500,
                'message' => 'error',
                'data' => 'app-pass key không hợp lệ vui lòng kiểm tra lại'
            ]);

        }

        return $next($request);
    }
}
