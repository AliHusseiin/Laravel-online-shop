<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class,'index']
    
);
Route::get('/shop', [HomeController::class, 'shop']);
Route::get('/cart',[CartController::class,'index'] );
Route::get('/checkout',[CheckoutController::class,'index'] );
Route::get('/contact',[ContactController::class,'index'] );
Route::get('/details',[DetailController::class,'index'] );
Route::get('/details/{id}',[DetailController::class,'index'] );
Route::get('/add-product',[HomeController::class,'add_product'] );
Route::get('/addtowishlist',[HomeController::class,'addToWishList'] );
Route::get('/inc-product',[CartController::class,'incProduct'] );
Route::get('/dec-product',[CartController::class,'decProduct'] );
Route::get('/rem-product',[CartController::class,'removeProduct'] );
Route::put('/{id}', [HomeController::class, 'newsLetter']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Route::middleware(['auth','can:is_admin'])->group(function () { 
//   Route::resource('admin', AdminController::class);
// });
Route::middleware(['auth', 'can:is_admin'])->prefix('admin')->group(function () {
  Route::get('', [AdminController::class, 'index']);
  Route::resource('categories', CategoryController::class);
  Route::resource('products', ProductController::class);
});
Route::middleware(['auth'])->group(function () {
  Route::get('/checkout',[CheckoutController::class,'index'] );
 
});
