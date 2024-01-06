<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangeUserRole;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;


//after login routes
Route::middleware(['auth'])->group(function () {
    //admin 

    //admin category list
    Route::group(["prefix" => "admin" , "middleware" => "admin_auth"] , function(){
        Route::get("list" , [CategoryController::class , "list"])->name("admin#categorylist");
        Route::get("createpage" , [CategoryController::class , "createPage"])->name("admin#createPage");
        Route::post("createitem" , [CategoryController::class , "createItem"])->name("admin#createItem");
        Route::get("delete/{id}" , [CategoryController::class , "deleteItem"])->name("admin#delete");
        Route::get("editpage/{id}" , [CategoryController::class , "editPage"])->name("admin#editPage");
        Route::post("updatepage" , [CategoryController::class , "updateItem"])->name("admin#updatePage");

        //admin account password
        Route::get("changePasswordPage", [AdminController::class , "changePasswordPage"])->name("admin#changePasswordPage");
        Route::post("changePassword" , [AdminController::class , "changePassword"])->name("admin#changePassword");

        //admin account info
        Route::get("accountinfopage" , [AdminController::class , "accountInfo"])->name("admin#accountInfoPage");

        //admin account update 
        Route::get("accountupdate" , [AdminController::class , "accountUpdate"])->name("admin#accountUpdatePage");
        Route::post("updateaccount" ,[AdminController::class , "updateAcc"])->name("admin#updateAcc");
        
        //admin list
        Route::get("listadmin" , [AdminController::class, "adminList"])->name("admin#listOfAdmin");
        Route::get("delete/{id}" , [AdminController::class , "adminDelete"])->name("admin#delete");
        Route::get("changerole/{id}" ,[AdminController::class, "adminChange"])->name("admin#changerole");
        Route::post("updaterole/{id}", [AdminController::class, "adminRoleUpdate"])->name("admin#updateRole");
        //user feedback
        Route::get("userfeedback" , [AdminController::class ,"userFeedback"])->name("admin#userFeedBack");
        Route::get("deletefeedback/{id} ",[AdminController::class,"deleteFeedBack"])->name("admin#deleteFeedback");

        
    });

    //admin product list

    Route::group(["prefix" => "product" , "middleware" => "admin_auth"] , function(){
        Route::get("list" , [ProductController::class , "listPage"])->name("product#listPage");
        Route::get("createProductPage" , [ProductController::class , "createProductPage"])->name("product#createPage");
        Route::post("createPizza" , [ProductController::class , "createPizza"])->name("product#createPizza");
        Route::get("deletePizza/{id}" , [ProductController::class , "deletePizza"])->name("product#deletePizza");
        Route::get("seemorePizza/{id}" , [ProductController::class , "seemorePizza"])->name("product#seemorePizza");
        Route::get("updatePage/{id}" ,[ProductController::class , "updateProductPage"])->name("product#updatePizzaPage");
        Route::post("updatePizza" , [ProductController::class , "updatePizza"])->name("product#updatePizza");
    });

    //admin ordr list
    Route::group(["prefix" => "order","middleware" => "admin_auth"], function(){
        Route::get("list" , [OrderController::class, "orderList"])->name("admin#orderList");
        Route::get("sorting",[OrderController::class,"orderSorting"])->name("admin#orderSorting");
        Route::get("changestatus", [OrderController::class,"changeStatus"])->name("admin#changeStatus");
        Route::get("productlist/{ordercode}",[OrderController::class,"productList"])->name("admin#orderProductList");
    });

    Route::group(["prefix" => "userchangerole","middleware" => "admin_auth"], function(){
        Route::get("list",[ChangeUserRole::class,"userList"])->name("admin#changeUserRole");
        Route::get("change",[ChangeUserRole::class,"changeRole"])->name("admin#Change");
    });

    //user
    Route::group(["prefix" => "user" , "middleware" => "user_auth"] , function(){
        Route::get("home" , [UserController::class , "userHomePage"])->name("user#home");
        Route::get("changePasswordPage" , [UserController::class, "changePasswordPage"])->name("user#changePasswordPage");
        Route::post("changePassword" , [UserController::class, "changePassword"])->name("user#changePassword");
        Route::get("updateAccPage" , [UserController::class,  "updateAccPage"])->name("user#updateAccPage");
        Route::post("updateAcc" , [UserController::class , "updateAcc"])->name("user#updateAcc");
        //filter by category id 
        Route::get("filter/{id}",[UserController::class , "Filter"])->name("user#filter");
        //ajax data
        Route::get("ajaxdata",[AjaxController::class , "ajaxData"])->name("user#ajaxData");
        Route::get("ordercount", [AjaxController::class, "order"])->name("user#orderCount");
        Route::get("orderlist",[AjaxController::class,"orderList"])->name("user#orderList");
        Route::get("clearorder" , [AjaxController::class,"clearOrder"])->name("user#clearOrder");
        Route::get("singlecartdelete",[AjaxController::class,"deleteSingleCart"])->name("user#deleteSingleCart");
        Route::get("viewcount" ,[AjaxController::class,"addViewCount"])->name("admin#viewCount");
        // product datail page
        Route::get("info/{id}",[UserController::class,"information"])->name("user#information");
        //product cart
        Route::get("cart" , [UserController::class , "Cart"])->name("user#cart");
        Route::get("orderhistory",[UserController::class,"orderhistory"])->name("user#orderhistorty");
        //contact 
        Route::get("contactpage",[UserController::class,"contactPage"])->name("user#contactPage");
        Route::post("usermessage",[UserController::class,"userMessage"])->name("user#Message");

    });
});

//login , register routes
    Route::redirect("/" , "loginpageuser");
    Route::get("registerpage" , [AuthController::class , "registerFunction"])->name("auth#registerPage");
    Route::get("loginpageuser" , [AuthController::class , "loginFunction"])->name("auth#loginPage");


//redirect links 
Route::get("redirectlink" , [AuthController::class , "redirect"])->name("redirect");






