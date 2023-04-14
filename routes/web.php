<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('login',[LoginController::class,'loginCheck'])->name('login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    Route::group(['prefix'=>'products'], function () {
        Route::get('/',[ProductController::class,'index'])->name('products.index');
        Route::get('create', [ProductController::class,'create'])->name('prod.create');
        Route::post('store', [ProductController::class,'store'])->name('products.store');
        Route::patch('{id}/edit', [ProductController::class,'edit'])->name('products.edit');
        Route::put('{id}/update', [ProductController::class,'update'])->name('products.update');
        Route::delete('{id}/delete', [ProductController::class,'destroy'])->name('products.destroy');
    });
    
    Route::get('logout',[LoginController::class,'logout'])->name('logout');
});


