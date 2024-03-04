<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(){
        return view('auth.passwords.change');
    }

    public function updatePassword(ChangePassword $request){
        $password=Auth::user()->password;
        if (Hash::check($request->oldpass,$password)) {
            $user=User::find(Auth::id());
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::logout();
            $notification=array(
                'message'=>'Password has been successfully changed.',
                'alert-type'=>'success'
            );
            return Redirect()->route('trigger.login')->with($notification);
        }else{
            return Redirect()->back()->with("error","The old password you have entered is incorrect.");
        }
    }
}
