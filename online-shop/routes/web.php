<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
Route::prefix('admin')->group(function () {
  Route::get('', [AdminController::class, 'admin']);
  Route::get('categories', [CategoryController::class, 'index']);
  Route::get('addCategory', [CategoryController::class, 'create']);
  Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.categories');
  Route::get('{id}/edit', [CategoryController::class, 'edit']);
  Route::put('{id}', [CategoryController::class, 'update']);
  Route::delete('{id}', [CategoryController::class, 'destroy']);

  // Route::get('/admin/products', [ProductsController::class, 'productsPage']);
// Route::get('/admin/addProduct', [ProductsController::class, 'addProduct']);
  Route::resource('products', ProductController::class);
  // Route::get('addProduct', [ProductController::class, 'create']);
});
