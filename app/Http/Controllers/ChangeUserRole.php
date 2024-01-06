<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChangeUserRole extends Controller
{
    //user list
    public function userList(){
        $userdata = User::where("role","user")->paginate();
        return view("admin.useraccount.userlist",compact("userdata"));
    }

    //change role
    public  function changeRole(Request $data){
        User::where("id",$data->userid)->update([
            "role" => $data->role
        ]);
        return ["status" => "success"];

    }
}
