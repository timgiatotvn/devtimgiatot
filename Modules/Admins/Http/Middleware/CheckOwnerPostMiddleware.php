<?php

namespace Modules\Admins\Http\Middleware;

use App\Model\Post;
use Closure;

class CheckOwnerPostMiddleware
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
        $post = Post::find($request->id);

        if (empty($post)) {
            return back()->with('error', 'Tin này không tồn tại');
        }
        $roles = auth('admins')->user()->roles->pluck('name')->toArray();

        if (!in_array(ROLE_ADMIN, $roles)) {
            if ($post->admin_id == auth('admins')->user()->id || $post->admin_id == -1) {
                return $next($request);
            }

            return back()->with('error', 'Tin này không phải của bạn');
        }

        return $next($request);
    }
}
