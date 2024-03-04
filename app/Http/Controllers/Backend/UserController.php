<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\TraitMyFunctions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use TraitMyFunctions;

    public function listUsers(){
        $users =  $this->getUsers();
        return view('backend.user.users', compact('users'));
    }

    public function listMessages(){
        $messages =  $this->getUserMessages();
        return view('backend.user.messages', compact('messages'));
    }
}
