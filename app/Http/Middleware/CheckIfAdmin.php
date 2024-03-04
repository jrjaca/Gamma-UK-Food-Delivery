<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
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
        //Check if admin
        //0-superuser, 1-admin, 2-member
        if (Auth::user() && Auth::user()->access_code != '1') {
            $notification = array(
                'message' => 'Unauthorized access! For administrator only.',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
        return $next($request);
    }
}
