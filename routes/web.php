<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\OrderManagementController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('testp',function(){
    return view('dashboard.products.testp');
});


Route::middleware(['custom_admin'])->group(function(){
    Route::redirect('/','login_page');

Route::get('login_page',[AuthController::class,'loginPage'])->name('loginPage');
Route::get('register_page',[AuthController::class,'registerPage'])->name('registerPage');

});

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [AuthController::class,'home']);
    // Start Dashboard
    Route::middleware(['custom_admin'])->group(function(){
        Route::group(['prefix' => 'products'], function(){
            Route::get('/', [ProductController::class, 'index'])->name('productList');
            Route::get('create',[ProductController::class,'create'])->name('productCreate');
            Route::post('store',[ProductController::class,'store'])->name('productStore');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('productDelete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('productEdit');
            Route::post('update/{id}',[ProductController::class,'update'])->name('productUpdate');
            Route::get('show/{id}',[ProductController::class,'show'])->name('productDetail');

        });

        Route::group(['prefix' => 'categories'], function(){
            Route::get('/', [CategoryController::class, 'index'])->name('categoryList');
            Route::get('create', [CategoryController::class, 'create'])->name('categoryCreate');
            Route::post('store', [CategoryController::class, 'store'])->name('categoryStore');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('categoryDelete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('categoryEdit');
            Route::post('update/{id}',[CategoryController::class,'update'])->name('categoryUpdate');
        });

        Route::group(['prefix' => 'orders'],function(){
            Route::get('/',[OrderManagementController::class,'index'])->name('orderList');
            Route::get('/pagination/fetch_data', [OrderManagementController::class,'fetch_data']);
            Route::get('changeOrderStatus',[OrderManagementController::class,'changeOrderStatus']);
            Route::get('detail/{order_code}',[OrderManagementController::class,'orderDetail'])->name('orderDetail');
        });

       

        // Start Admin Profile
        Route::group(['prefix' => 'admin'],function(){
            Route::get('show_prfile',[AuthController::class,'showProfile'])->name('showProfile');
            Route::get('edit_profile',[AuthController::class,'editProfile'])->name('editProfile');
            Route::get('password_page',[AuthController::class,'changePasswordPage'])->name('changePasswordPage');
        });
        //End Admin Profile

        // User Management
        Route::group(['prefix' => 'users'],function(){
            Route::get('/',[UserController::class,'index'])->name('userList');
            Route::get('edit-change-role/{id}',[UserController::class,'editChangeRole'])->name('editChangeRole'); 
            Route::post('update-change-role/{id}',[UserController::class,'updateChangeRole'])->name('updateChangeRole');// use laravel
            Route::get('change-role',[UserController::class,'changeRoleUsingAjax'])->name('changeRoleUsingAjax'); // use ajax
            Route::get('delete/{id}',[UserController::class,'delete'])->name('deleteUser'); 
        });
         //End User Management

         //Contact 
         Route::get('contact',[ContactController::class,'index'])->name('contactList');
         Route::get('contact/delete/{id}',[ContactController::class,'delete'])->name('contactDelete');
    });
    
    Route::post('update_profile',[AuthController::class,'updateProfile'])->name('updateProfile');
    Route::post('change_password',[AuthController::class,'changePassword'])->name('changePassword');
    
    //End Dashboard


    // Start Frontend
    Route::get('/home_page',[HomeController::class,'home'])->name('fontendHomePage');
    Route::get('/product-filter',[HomeController::class,'productFilter'])->name('productFilter');
    Route::get('/product_detail/{id}',[HomeController::class,'productDetail'])->name('frontendProductDetail');

    Route::group(['prefix' => 'contact'],function(){
        Route::post('store',[ContactController::class,'store'])->name('contactStore');
        Route::get('create',[ContactController::class,'create'])->name('contactCreate');
    });
   
    Route::group(['prefix' => 'cart'],function(){
        Route::get('list',[CartController::class,'cartList'])->name('cartList');
        Route::get('remove_product',[CartController::class,'removeProduct'])->name('removeProduct');
    });
    Route::get('add_to_cart',[CartController::class,'addToCart'])->name('addToCart');
    Route::group(['prefix' => 'order'],function(){
        Route::get('create',[OrderController::class,'create'])->name('orderCreate');
        Route::get('history',[OrderController::class,'orderHistory'])->name('orderHistory');
    });
    Route::group(['prefix'=> 'profile'],function(){
        Route::get('edit',[ProfileController::class,'editProfile'])->name('frontendEditProfile');
        Route::get('edit_password',[ProfileController::class,'editPassword'])->name('frontendEditPassword');
    });

    // End Frontend
});

Route::group(['prefix'=> 'test_raw_query'],function(){

    Route::get('products',function(){
        //inner join
       return Product::select('products.*','categories.name as category_name')
       ->join('categories','categories.id','products.category_id') //Selects records that have matching values in both tables.
       ->get();
    });
    // Left Join
    //    return Product::select('products.*','categories.name as category_name')
    //    ->leftJoin('categories','products.category_id','categories.id') //Return all records from the left table (table1), and the matching records (if any) from the right table (table2).
    //    ->get();
    // });

    // Right Join
    // return Product::select('products.*','categories.name as category_name')
    //->rightJoin('categories','products.category_id','categories.id') //Return all records from the right table (table2), and the matching records (if any) from the left table (table1)
    // ->get();
    //  });

    Route::get('orders',function(){
        return Order::select('users.name as user_name','products.name as product_name','orders.product_id','orders.user_id')
        ->join('users','users.id','orders.user_id')
        ->join('products','products.id','orders.product_id')
        ->get();
    });

    Route::get('orders/products',function(){
        return Order::select('orders.product_id',DB::raw('count(orders.user_id) as user_count'))
        ->join('users','users.id','orders.user_id')
        ->join('products','products.id','orders.product_id')
        ->groupBy('orders.product_id')
        ->get();
    });
});