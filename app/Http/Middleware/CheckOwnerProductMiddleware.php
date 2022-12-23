<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Product;

class CheckOwnerProductMiddleware
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
        $product = Product::find($request->id);

        if ($product->shop_id != auth('users')->user()->id) {
            return back()->with('error', 'Sản phẩm này không phải của bạn');
        }
        return $next($request);
    }
}
