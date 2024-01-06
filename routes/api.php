<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\apicontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post("createcategory" ,[apicontroller::class , "createCategory"]);//CREATE

Route::get("categorylist/{id}" , [apicontroller::class , "categoryList"]);//READ

Route::post("updatecategory" , [apicontroller::class , "updateCategory"]);//UPDATE

Route::get("deletecategory/{id}" , [apicontroller::class , "deleteCategory"]);//DELETE 



