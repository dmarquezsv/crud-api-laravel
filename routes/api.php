<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// añadimos los controladores
use App\Http\Controllers\Api\V1\Admin\User\UserController;
use App\Http\Controllers\Api\V1\Admin\User\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Admin\Product\ProductController;

//CREAR LAS RUTAS DE LOS USUARIOS PARA USO PUBLICO
Route::post('v1/admin/users/register', [UserController::class,'register'])->name('register_user'); // Registrar un usuario
Route::post('v1/admin/auth/tokens', [UserController::class,'login']); //Iniciar Sesión
Route::post('v1/admin/auth/forget-password', [ForgotPasswordController::class,'forgetPassword']); // recuperar cuenta por correo electronico
Route::post('v1/admin/auth/reset-password', [ForgotPasswordController::class,'resetPassword']); // resetear la contraseña

//CREAR LAS RUTAS USANDO LA AUTENTICACIÓN SANCTUM
Route::group(['middleware' => ["auth:sanctum"]],function(){
    
    //Rutas de autenticacion
    Route::get('v1/admin/user/profile', [UserController::class,'userProfile']); // Extrar información del usuario usando el token
    Route::get('v1/admin/user/logout', [UserController::class,'logout']); // Cerrar sesión del usuario
    
    //Rutas de usuarios
    Route::get('v1/admin/users/show', [UserController::class,'listUsers']);
    Route::put('v1/admin/user/update/{id}', [UserController::class,'updateUser']);
    Route::delete('v1/admin/user/delete/{id}', [UserController::class,'deleteUser']);

    //Rutas de productos
    Route::post('v1/admin/products/register', [ProductController::class,'createProduct']); // Registrar un producto
    Route::get('v1/admin/products/show', [ProductController::class,'listProduct']); // Mostrar los productos
    Route::get('v1/admin/products/show/{id}', [ProductController::class,'showProduct']); // Mostrar los productos
    Route::put('v1/admin/product/update/{id}', [ProductController::class,'updateProduct']);
    Route::delete('v1/admin/product/delete/{id}', [ProductController::class,'deleteProduct']);
    Route::delete('v1/admin/product/delete/{id}', [ProductController::class,'deleteProduct']);
    Route::post('v1/admin/products/search-product', [ProductController::class,'searchProduct']); // Mostrar los productos
   
    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
