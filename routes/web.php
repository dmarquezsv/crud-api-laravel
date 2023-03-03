<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\V1\Admin\product\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

#Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\Web\V1\Admin\product\ProductController::class, 'index'])->name('home'); // Mostar los productos
Route::post('/home', [App\Http\Controllers\Web\V1\Admin\product\ProductController::class, 'store'])->name('products-store'); // Crear un producto
Route::delete('/home/{id}',[App\Http\Controllers\Web\V1\Admin\product\ProductController::class, 'destroy'])->name('products-destroy'); // Eliminar un producto