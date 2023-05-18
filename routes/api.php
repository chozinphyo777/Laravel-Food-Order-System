<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'categories'],function(){
Route::get('/',[CategoryController::class,'allCategories']); //Read all
Route::post('create',[CategoryController::class,'createCategory']);//Create
Route::get('delete/{category_id}',[CategoryController::class,'deleteCategory']);//Delete
Route::get('detail/{category_id}',[CategoryController::class,'detailCategory']);//Read specific id
Route::post('update/{category_id}',[CategoryController::class,'updateCategory']);//Update
});

Route::group(['prefix' => 'products'],function(){
    Route::get('/',[ProductController::class,'allProducts']); //Read all
    Route::post('create',[ProductController::class,'createProduct']);//Create
});


/**
 * Category list
 * GET  http://127.0.0.1:8000/api/categories 
 * 
 * Category Create
 * POST http://127.0.0.1:8000/api/categories/create
 * Body form-data
 * key => name
 * 
 * Category Delete
 * GET http://127.0.0.1:8000/api/categories/delete/6
 * 
 * Category Detail
 * GET http://127.0.0.1:8000/api/categories/detail/5
 * 
 * Category Update
 * POST http://127.0.0.1:8000/api/categories/update/1
 * Body form-data
 * key => name
 * 
 */

 /**
  * Product list
 * GET  http://127.0.0.1:8000/api/products 
 * 
 * Product Create
 * POST http://127.0.0.1:8000/api/products/create
 * Body form-data
 * key => name
 * 
 * 
 * 
  */

