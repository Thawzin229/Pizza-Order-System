<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //homepage
    public function userHomePage(){
        $pizza  = Product::paginate(6);
        $category = Category::paginate();
        $cart  = Cart::where("user_id" , Auth::user()->id)->paginate();
        $orderdata = Order::where("user_id" ,Auth::user()->id)->paginate();
        return view("user.homepage.home" , compact("pizza" , "category","cart","orderdata"));
    }
    //change password page
    public function changePasswordPage(){
        return view("user.password.change");
    }

    //change passowrd
    public function changePassword(Request $data){
        $this->validationForPasswordUpdate($data);
        $id = Auth::user()->id;
        $oldData = User::where("id" ,$id)->first()->toArray();
        $dbPass  = $oldData["password"];
        if(Hash::check($data->oldpassword , $dbPass)){
            $finalData = $this->indirectdataForPassword($data);
            User::where("id" ,$id)->update($finalData);
            Auth::logout();
            return redirect()->route("auth#loginPage");
        }
        return redirect()->route("user#changePasswordPage")->with(["error" => "old password is invalid to change password"]);
    }
    //update acc page
    public function updateAccPage(){
        return view("user.account.update");
    }
    //updat acc
    public function updateAcc(Request $data){
        $id = Auth::user()->id;
        $this->validationForUpdateAcc($data,$id);
        $finalDataForUpdate = $this->indirectdataForUpdateAcc($data);
        if($data->hasFile('image')){
            $oldfile  = User::where("id" ,$id)->first()->toArray();
            $oldImage  = $oldfile["image"];
            if($oldImage != null){
                Storage::delete("public/".$oldImage);
            }
            $fileName = uniqid() . $data->file("image")->getClientOriginalName();
            $data->file("image")->storeAs("public/". $fileName);
            $finalDataForUpdate["image"] = $fileName;
        }
        User::where("id" ,$id)->update($finalDataForUpdate);
        return redirect()->route("user#home")->with(["updatesuccess" => "user profile changed successfully"]);
        
        
    }

    //filter product
    public function Filter($id){
        $pizza  = Product::where("category_id",$id)->paginate(6);
        $category = Category::paginate();
        $cart = Cart::where("user_id", Auth::user()->id)->paginate();
        $orderdata = Order::where("user_id" ,Auth::user()->id)->paginate();
        return view("user.homepage.home" , compact("pizza" , "category", "cart","orderdata"));
    }
        //pizza datail page
        public function information($id){
            $pizzaInfo = Product::where("id" ,$id)->first()->toArray();
            $pizzaList = Product::paginate();
            return view("user.homepage.pizzainfo",compact("pizzaInfo","pizzaList"));
        }

        //cart 
        public function Cart(){
            $datas = Cart::select("carts.*","products.name as product_name" , "products.price as product_price")
            ->join("products" ,"carts.product_id" , "products.id")
            ->where("carts.user_id" , Auth::user()->id)
            ->paginate(5);
            $totalPrice = 0;
            foreach($datas as $item){
                $totalPrice += $item["product_price"]  * $item["quantity"];
            }
            return view("user.homepage.cart", compact("datas", "totalPrice"));
        }

        //order history
        public function orderhistory(){
            $orderhistorydata = Order::where("user_id",Auth::user()->id)->orderBy("created_at","desc")->paginate(4);
            return view("user.homepage.history",compact("orderhistorydata"));
        }
      

    
      //validation for changing password
      public function validationForPasswordUpdate($data){
        $validationRules = [
            "oldpassword" => "required|min:5|max:10",
            "newpassword" => "required|min:5|max:10",
            "passwordConfirm" => "required|min:5|max:10|same:newpassword"
        ];
        Validator::make($data->all() ,$validationRules )->validate();

      }
      public function indirectdataForPassword($data){
        $indirectdataForPassword =  [
            "password" => Hash::make($data->newpassword)
        ];
        return $indirectdataForPassword;
      }

      //contact page
      public function contactPage(){
        return view("user.contact.contact");
      }

      //user message 
      public function userMessage(Request $data){
        $this->validationForFeedBack($data);
        Contact::create(["name" => $data->name , "email" => $data->email , "message" => $data->message]);
        return redirect()->route("user#home");

      }
  
    

    /////////////////////////////////////////////////////////
    
    //validation for update acc
    public function validationForUpdateAcc($data,$id){
        $validationRules = [
            "name" => "required|min:4|max:40|unique:users,name,".$id,
            "email" => "required|min:4|max:40|unique:users,email,".$id,
            "phone" => "required",
            "gender" => "required",
            "address" => "required"
        ];
        Validator::make($data->all() , $validationRules)->validate();
    }

    public function indirectdataForUpdateAcc($data){
        $indirectdataForUpdateAcc = [
            "name" => $data->name,
            "email" => $data->email,
            "phone" => $data->phone,
            "gender" => $data->gender,
            "address" => $data->address
        ];
        return $indirectdataForUpdateAcc;
    }

    //validatoin for feedback
    public function validationForFeedBack($data){
        $validationRules = [
            "name" => "required|min:4",
            "email" => "required",
            "message" => "required|min:4"
        ];
        Validator::make($data->all(),$validationRules)->validate();
    }
    
}
