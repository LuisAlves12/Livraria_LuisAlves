<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function index(){
        $users= User::paginate(4);
        return view('users',[
            'users'=>$users
        ]);
    }
}
