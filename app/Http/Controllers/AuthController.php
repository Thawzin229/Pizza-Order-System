<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //login 
    public function loginFunction(){
        return view("authantication.login");
    }

    //register
    public function registerFunction(){
        return view("authantication.register");
    }

    //redirect
    public function redirect(){
        if(Auth::user()->role == "admin"){
            return redirect()->route("admin#categorylist");
        }else{
            return redirect()->route("user#home");
        }
    }
   
}
