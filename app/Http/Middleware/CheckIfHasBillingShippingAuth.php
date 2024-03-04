<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckIfHasBillingShippingAuth
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
        $errorMessage = array();
        if (!Auth::check()){
            $errorMessage[] = "Login your account or Register.";
        }

        if (!Session::has('b_address')){
            $errorMessage[] = "Provide your billing address.";
        }

        if (!Session::has('s_address')){
            $errorMessage[] = "Provide your shipping address.";
        }

        if (!empty($errorMessage)){
            $notification = array(
                'message' => 'Please check error message.',
                'alert-type' => 'warning'
            );
            return redirect()->route('show.checkout')
                ->withErrors(['token' => $errorMessage]) //flash message
                ->with($notification); //pop-up message
        }

        return $next($request);
    }
}
