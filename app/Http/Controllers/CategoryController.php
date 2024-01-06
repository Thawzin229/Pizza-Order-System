<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //list direct link

    public function list(){
        $searchVal  = request("searchVal");
        $categoriesData = Category::when($searchVal , function($table,$searchVal){
            $table->where("name" , "like" , "%{$searchVal}%")->paginate(5);
        })->orderby("created_at" , "desc")->paginate(5);
        return view("admin.category.list" , compact("categoriesData"));
    }
    //create page
    public function createPage(){
        return view("admin.category.create");
    }
    //create item
    public function createItem(Request $data){
        $this->validation($data);
        $finalData = $this->indirectData($data);
        Category::create($finalData);
        return redirect()->route("admin#categorylist");

    }

    //delet data
    public function deleteItem($id){
        Category::where("id" ,$id)->delete();
        return redirect()->route("admin#categorylist")->with(["deletesuccess" => "item deleted"]);

    }

    //edit page
    public function editPage($id){
        $editdata = Category::where("id" , $id)->first()->toArray();
        return view("admin.category.update" , compact("editdata"));
    }

    //update itme
    public function updateItem(Request $data){
    $id = $data->idforupdate;
    $this->validationForUpdate($data);
    $finalDataForUpdate = $this->indirectDataForUpdate($data);
    Category::where("id" ,$id)->update($finalDataForUpdate);
        return redirect()->route("admin#categorylist");



    }
    //validation for create
    public function validation($data){
        $validationRules = [
            "categoryName"  => "required|unique:categories,name"
        ];
        Validator::make($data->all(), $validationRules)->validate();
    }
    //validation for update
    public function validationForUpdate($data){
        $validationRules = [
            "itemNameforupdate"  => "required|unique:categories,name,".$data->idforupdate
        ];
        Validator::make($data->all(), $validationRules)->validate();
    }
    //for create format
    public function indirectData($data){
        $indirectData = [
            "name" => $data->categoryName
        ];
        return $indirectData;
    }
    //for update format
    public function indirectDataForUpdate($data){
        $indirectDataForUpdate = [
            "name" => $data->itemNameforupdate
        ];
        return $indirectDataForUpdate;
    }
}
