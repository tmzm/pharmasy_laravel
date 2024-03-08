<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// *---- Shared Routes ----*
Route::group([
    'middleware'=>['auth:api']
],function(){
    Route::get('users/destroy',[UserController::class,'destroy']);

    Route::post('users/update',[UserController::class,'update']);

    // upgrade admin to accepted admin
    Route::post('users/admin/{user_id}/upgrade',[UserController::class,'upgrade']);

    //get all users
    Route::get('users',[UserController::class,'index']);

    Route::post('users/update',[UserController::class,'update']);

    Route::get('users/show',[UserController::class,'show']);

    Route::post('users/fcm_token_edit',[UserController::class,'edit']);

    Route::post('notify',[NotificationController::class,'notify']);

    Route::get('products',[ProductController::class,'index']);
    Route::get('products/{product_id}',[ProductController::class,'show']);

    Route::get('orders',[OrderController::class,'index']);
    Route::post('orders/{order_id}/update',[OrderController::class,'update']);
    Route::post('orders/create',[OrderController::class,'create']);

    Route::get('prescriptions',[PrescriptionController::class,'index']);
    Route::get('prescriptions/{prescription_id}/orders/{order_id}',[PrescriptionController::class,'update']);

    //all categories
    Route::get('categories',[CategoryController::class,'index']);
});

Route::post('users/create',[UserController::class,'create']);

Route::post('users/store',[UserController::class,'store']);

// *---- End shared Routes ----*


// *---- App Routes ----*
Route::group([
    'middleware'=>['auth:api','user']
],function(){

    //orders
    Route::get('orders/{order_id}/show',[OrderController::class,'show']);
    Route::delete('orders/{order_id}/delete',[OrderController::class,'destroy']);
    Route::delete('orderItems/{orderItem_id}/delete',[OrderItemController::class,'destroy']);

    //favorites
    Route::get('favorites',[FavoriteController::class,'index']);
    Route::get('favorites/{order_id}',[FavoriteController::class,'show']);
    Route::post('favorites/product/{product_id}/create',[FavoriteController::class,'create']);
    Route::delete('favorites/{favorites_id}/delete',[FavoriteController::class,'destroy']);

    Route::post('prescriptions/create',[PrescriptionController::class,'create']);

});
// *---- End app Routes ----*


// *---- Web Routes ----*
Route::group([
    'middleware'=>['auth:api']
],function(){
    //products
    Route::post('products/create',[ProductController::class,'create']);
    Route::post('products/import',[ProductController::class,'import']);
    Route::post('products/{product_id}/update',[ProductController::class,'update']);
    Route::delete('products/{product_id}/delete',[ProductController::class,'destroy']);

    //categories
    Route::post('categories/{category_id}/update',[CategoryController::class,'edit']);
    Route::post('categories/create',[CategoryController::class,'create']);
    Route::delete('categories/{category_id}/delete',[CategoryController::class,'destroy']);
});
// *---- End web Routes ----*

