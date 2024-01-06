<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     //change password page
    public function changePasswordPage(){
        return view("admin.password.changePass");
    }


    //change password / update password

    public function changePassword(Request $data){
        $this->validationForPassword($data);
        $id =  Auth::user()->id;
        $userData = User::where("id" ,$id)->first()->toArray();
        $dabasePassword = $userData["password"];
        if(Hash::check($data->oldpassword , $dabasePassword)){
        $finalData = $this->passwordUpdate($data);
        User::where("id" , $id)->update($finalData);
        Auth::logout();
        return redirect()->route("auth#loginPage");
        }else{
        return redirect()->route("admin#changePasswordPage")->with(["error" => "old password is invalid"]);
        }
        

    }

    //to account infomation page
    public function accountInfo(){
        return view("admin.account.account");
    }

    //to update account page
    public function accountUpdate(){
        return view("admin.account.update");
    }

    //validation for changing password

    public function validationForPassword($data){
        $validationRules = [
            "oldpassword" => "required|min:6|max:10",
            "newpassword" => "required|min:6|max:10",
            "passwordConfirm" => "required|min:6|max:10|same:newpassword"

        ];
        Validator::make($data->all(),$validationRules)->validate();
    }

    //update accc
    public function updateAcc(Request $data){
        $this->validation($data);
        $id = Auth::user()->id;
        $finalData = $this->indirectdata($data);
        if($data->hasFile("image")){
            $oldfile =  User::where("id" , $id)->first()->toArray();
            $oldImage = $oldfile["image"];
            if($oldImage != null){
                Storage::delete("public/".$oldImage);
            }
            $fileName =  uniqid() . $data->file("image")->getClientOriginalName();
            $data->file("image")->storeAs("public",$fileName);
            $finalData["image"] = $fileName;
        }
        User::where("id" ,$id)->update($finalData);
        return redirect()->route("admin#categorylist")->with(["updatedacc"=>"updating account finished"]);


    }
    //adminlist page
    public function adminList(){
        $searchVal = request("searchVal");
        $data = User::when($searchVal , function($table , $searchVal){
            $table->orwhere("name" , "like" ,"%{$searchVal}%")
            ->orwhere("phone" , "like" ,"%".request("searchVal")."%")
            ->orwhere("gender" , "like" ,"%".request("searchVal")."%")
            ->orwhere("email" , "like" ,"%".request("searchVal")."%")
            ->orwhere("address" , "like" ,"%".request("searchVal")."%")->paginate(3);
        })->where("role" , "admin")->paginate(3);
        return view("admin.account.list", compact("data"));
    }
    //admin list delete
    public function adminDelete($id){
        User::where("id" ,$id)->delete();
        return redirect()->route("admin#listOfAdmin");
    }

    //admin change role
    public function adminChange($id){
        $roleData = User::where("id" ,$id)->first()->toArray();
        return view("admin.account.changeRole" , compact("roleData"));
    }
    //update admin role
    public function adminRoleUpdate($id , Request $data){
        $finalData = $this->roleUpdateData($data);
        User::where("id" ,$id)->update($finalData);
        return redirect()->route("admin#listOfAdmin")->with(["changedrole" => "user's role has changed"]);
    }
    //user Feedback
     public function userFeedback(){
        $feedback = Contact::paginate();
        return view("admin.userfeedback.feedback",compact("feedback"));
     }

     public function deleteFeedBack($id){
        Contact::where("id" ,$id)->delete();
        return redirect()->route("admin#userFeedBack");
     }
    public function roleUpdateData($data){
        $indirectdata = [
            "role" => $data->role
        ];
        return $indirectdata;
    }
    public function passwordUpdate($data){
        $passwordUpdate = [
            "password" => Hash::make($data->newpassword)
        ];

        return $passwordUpdate;
    }
    public function indirectdata($data){
        $indirectdata = [
            "name" => $data->name,
            "email" => $data->email,
            "phone" => $data->phone,
            "gender" => $data->gender,
            "address" => $data->address
        ];
        return $indirectdata;
    }

    public function validation($data){
        $id = Auth::user()->id;
        $validationRules = [
            "name"  => "required|min:4|unique:users,name,".$id,
            "email"  => "required|unique:users,email,".$id,
            "phone"  => "required",
            "address"  => "required"
        ];
        Validator::make($data->all() ,$validationRules )->validate();
    }
}
