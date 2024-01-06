<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class apicontroller extends Controller
{
    //category list
    public function categoryList($id){
        $data  = Category::where("id", $id)->first();
        if(isset($data)){
            return $data;
        }
        return "there is no data";
    }

    //create 
    public function createCategory(Request $data){
        Category::create(["name" => $data->name]);
        $data  =  Category::get();
        return $data;
    }

    //delete
    public function deleteCategory($id){
        $todeletedata  = Category::where("id" ,$id)->first();
        if(isset($todeletedata)){
            Category::where("id" ,$id)->delete();
            return "delete success";
        }
        return "delete failed";

    }

    //update 
    public function updateCategory(Request $data){
        $toupdateData = Category::where("id" ,$data->id)->first();
        if(isset($toupdateData)){
            Category::where("id" ,$data->id)->update(["name" => $data->category_name]);
            return "update complete";
        }

        return "update failed";

    }
}

