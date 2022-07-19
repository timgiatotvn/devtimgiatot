<?php

namespace Modules\Admins\Http\Middleware;

use App\Model\Post;
use Closure;

class CheckIsAdminMiddleware
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
        $roles = auth('admins')->user()->roles->pluck('name')->toArray();

        if (in_array(ROLE_ADMIN, $roles)) {
            return $next($request);
        }

        return back()->with('error', 'Chỉ Admin mới có quyền truy cập');
    }
}
