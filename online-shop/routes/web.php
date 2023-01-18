<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

Route::get('/',[HomeController::class,'index'] );
Route::get('/shop', [HomeController::class, 'shop']);
Route::get('/admin', [AdminController::class, 'admin']);
Route::get('/admin/categories', [AdminController::class, 'categoriesPage']);
