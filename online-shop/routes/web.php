<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
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
Route::get('/admin/categories', [CategoryController::class, 'categoriesPage']);
Route::get('/admin/addCategory', [CategoryController::class, 'addCategory']);
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('layouts.categories');
Route::get('/admin/{id}/edit', [CategoryController::class, 'edit']);
Route::put('/admin/{id}', [CategoryController::class, 'update']);
Route::delete('/admin/{id}', [CategoryController::class, 'destroy']);
