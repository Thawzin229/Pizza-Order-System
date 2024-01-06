<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //create list page
    public function listPage(){
        $searchVal = request("searchVal");
        $products =  Product::select("products.*","categories.name as category_name","categories.created_at as date")
        ->join("categories" , "products.category_id" , "categories.id")
        ->when($searchVal  ,function($table , $searchVal){
            $table->where("products.name" , "like" , "%{$searchVal}%")->paginate(3);
        })->orderby("products.created_at" ,"desc")->paginate(3);
        return view("admin.product.list" , compact("products"));
    }
    //to create page
    public function createProductPage(){
        $categoryData =  Category::paginate();
        return view("admin.product.create", compact("categoryData"));
    }

    //create pizza
    public function createPizza(Request $data){
        $this->validation($data);
        $finalData = $this->indirectData($data);
        if($data->hasFile("image")){
            $fileName = uniqid(). $data->file("image")->getClientOriginalName();
            $data->file("image")->storeAs("public" , $fileName);
            $finalData["image"] = $fileName;
        }
        Product::create($finalData);
        return redirect()->route("product#listPage");


    }
    //deelte pizza
    public function deletePizza($id){
        Product::where("id" ,$id)->delete();
        return redirect()->route("product#listPage");

    }

    //seemore pizza
    public function seemorePizza($id){
        $seemorePizzaData = Product::select("products.*" , "categories.name as category_name")
        ->leftJoin("categories" , "products.category_id" , "categories.id")
        ->where("products.id" ,$id)->first()->toArray();
        return view("admin.product.seemore" , compact("seemorePizzaData"));
    }
    //update pizza page
    public function updateProductPage($id){
        $categoryData = Category::get()->toArray();
        $editPizzaData = Product::where("id" ,$id)->first()->toArray();
        return view("admin.product.update",compact("editPizzaData" , "categoryData"));
    }

    //update pizza 
    public function updatePizza(Request $data){
        $id = $data->idforupdate;
        $this->validationUpdate($data);
        $finalDataUpdate = $this->indirectDataUpdate($data);
        if($data->hasFile("image")){
            $oldfile = Product::where("id" ,$id )->first()->toArray();
            $oldImage = $oldfile["image"];
            if($oldImage != null){
                Storage::delete("public/".$oldImage);
            }
            $fileName = $data->file("image")->getClientOriginalName();
            $data->file("image")->storeAs("public" , $fileName);
            $finalDataUpdate["image"] = $fileName;
        }
        Product::where("id" ,$id)->update($finalDataUpdate);
        return redirect()->route("product#listPage");
        

    }
    
    //validation
    public function validation($data){
        $validationRules = [
            "name" => "required|min:4",
            "category_id" => "required",
            "description" => "required|min:4",
            "price" => "required",
            "image" => "required"
        ];
        Validator::make($data->all() , $validationRules)->validate();
    }

    //validation (update)
    public function validationUpdate($data){
        $validationRules = [
            "name" => "required|min:4",
            "description" => "required|min:4",
            "price" => "required",

        ];
        Validator::make($data->all() , $validationRules)->validate();
    }

    public function indirectData($data){
        $indirectData =  [
            "name" => $data->name,
            "category_id" => $data->category_id,
            "description" => $data->description,
            "price" => $data->price
        ];
        return $indirectData;
    }

    public function indirectDataUpdate($data){
        $indirectDataUpdate =  [
            "name" => $data->name,
            "description" => $data->description,
            "price" => $data->price,
            "category_id" => $data->category_id
        ];
        return $indirectDataUpdate;
    }
}
