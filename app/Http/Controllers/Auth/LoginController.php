<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
/*use http\Env\Request;*/
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, TraitMyFunctions;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm() //modified, original from use AuthenticatesUsers
    {
        //return view('auth.login');
        $site_setting = $this->getSiteSettings();
        return view('auth.login',compact('site_setting'));
    }

}
