<?php

namespace App\Http\Middleware;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use Closure;

class AuthApiRequest
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('app-pass') != env('API_PASS')) {
            return ResponseHelpers::serverErrorResponse([], "json");
        }
        return $next($request);
    }
}
