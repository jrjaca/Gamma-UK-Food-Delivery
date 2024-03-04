<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassword;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use AuthenticatesUsers;
    use TraitMyFunctions;

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

    public function triggerLogin(){
        $site_setting = $this->getSiteSettings();
        return view('auth.login',compact('site_setting'));
    }

    public function checkoutLogin(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $notification = array(
                'message'=>'Successfully logged in.',
                'alert-type'=>'success'
            );
        } else {
            $notification = array(
                'message'=>'Mismatched email and password.',
                'alert-type'=>'warning'
            );
        }
        return Redirect()->back()->with($notification);
    }

    public function checkoutRegister(Request $request){
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user)); //trigger the verify email
        auth()->login($user);

        $notification = array(
            'message'=>'Successfully registered..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification); // back to checkout page
    }

}
