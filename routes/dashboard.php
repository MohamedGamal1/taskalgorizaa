<?php

use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;

/*
|--------------------------------------------------------------------------
| dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>'auth' ,'as' => 'dashboard.','prefix' =>'dashboard'],function (){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/categories/trash',[CategoriesController::class,'trash'])->name('categories.trash');
    Route::resource('/categories',CategoriesController::class);
    Route::resource('/products',ProductsController::class);
});


