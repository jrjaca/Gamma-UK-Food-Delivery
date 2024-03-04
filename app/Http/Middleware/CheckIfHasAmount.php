<?php

namespace App\Http\Middleware;

use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckIfHasAmount
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
        if (Cart::total() <= 0) {
            $notification = array(
                'message' => 'You have no item in your cart.',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
        return $next($request);
    }
}
