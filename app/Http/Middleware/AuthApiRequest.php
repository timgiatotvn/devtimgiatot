<?php

namespace App\Http\Middleware;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use Closure;
use Illuminate\Support\Facades\Log;

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
        Log::info("33333 AuthApiRequest");
        if ($request->header('app-pass') != env('API_PASS')) {
            return ResponseHelpers::serverErrorResponse([], "json");
        }
        return $next($request);
    }
}
