<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// add the controllers
use App\Http\Controllers\Api\V1\Admin\User\UserController;
use App\Http\Controllers\Api\V1\Admin\User\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Admin\Product\ProductController;

//CREATE USER ROUTES FOR PUBLIC USE
Route::post('v1/admin/users/register', [UserController::class,'register'])->name('register_user'); // Register a user
Route::post('v1/admin/auth/tokens', [UserController::class,'login']); //Log in
Route::post('v1/admin/auth/forget-password', [ForgotPasswordController::class,'forgetPassword']); // retrieve account by email
Route::post('v1/admin/auth/reset-password', [ForgotPasswordController::class,'resetPassword']); // reset the password

//CREATE THE ROUTES USING SANCTUM AUTHENTICATION
Route::group(['middleware' => ["auth:sanctum"]],function(){
    
    //Authentication routes
    Route::get('v1/admin/user/profile', [UserController::class,'userProfile']); // Extract user information using the token
    Route::get('v1/admin/user/logout', [UserController::class,'logout']); // Log out the user
    
    //User paths
    Route::get('v1/admin/users/show', [UserController::class,'listUsers']);
    Route::put('v1/admin/user/update/{id}', [UserController::class,'updateUser']);
    Route::delete('v1/admin/user/delete/{id}', [UserController::class,'deleteUser']);

    //Product routes
    Route::post('v1/admin/products/register', [ProductController::class,'createProduct']); 
    Route::get('v1/admin/products/show', [ProductController::class,'listProduct']); 
    Route::get('v1/admin/products/show/{id}', [ProductController::class,'showProduct']); 
    Route::put('v1/admin/product/update/{id}', [ProductController::class,'updateProduct']); 
    Route::delete('v1/admin/product/delete/{id}', [ProductController::class,'deleteProduct']);
    Route::post('v1/admin/products/search-product', [ProductController::class,'searchProduct']);
   
    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
