<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

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
// Route::get('/' , [HomeController::class , 'index'])->middleware(['auth' , 'verified'])->name('home');
// Route::view('/login' , 'auth.login');
Route::get('/', function () {
    return view('auth.login');
});

Route::get('home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('cms/admin/')->middleware(['auth' , 'verified'])->group(function(){
    Route::view('home' , 'layouts.template')->name('home-cms');
    Route::resource('products' , ProductController::class);
    Route::get('product-trash' , [ProductController::class , 'trash'])->name('products.trash');
    Route::get('product-restore/{id}' , [ProductController::class , 'restore'])->name('products.restore');
    Route::get('product-restore-all' , [ProductController::class , 'restoreAll'])->name('products.restore-all');
    Route::get('product-force-delete/{id}' , [ProductController::class , 'forceDelete'])->name('products.force-delete');
    Route::get('product-delete-all' , [ProductController::class , 'deleteAll'])->name('products.delete-all');
    Route::resource('categories' , CategoriesController::class);
    Route::get('category-trash' , [CategoriesController::class , 'trash'])->name('categories.trash');
    Route::get('category-restore/{id}' , [CategoriesController::class , 'restore'])->name('categories.restore');
    Route::get('category-restore-all' , [CategoriesController::class , 'restoreAll'])->name('categories.restore-all');
    Route::get('category-delete-all' , [CategoriesController::class , 'deleteAll'])->name('categories.delete-all');
    Route::get('category-force-delete/{id}' , [CategoriesController::class , 'forceDelete'])->name('categories.force-delete');
    Route::resource('roles' , RolesController::class);
    Route::resource('users' , UserController::class);
    // Route::post('ratings' [RateController::class] , 'store');
    });
    Route::get('/cart' , [CartController::class , 'index'])->name('cart');
    Route::post('/cart' , [CartController::class , 'store']);
    Route::get('products/{slug}' , [ControllersProductController::class , 'show'])->name('products.details');
    Route::get('/checkout' , [CheckoutController::class , 'create'])->name('checkout');
    Route::post('/checkout' , [CheckoutController::class , 'store']);

    Route::get('/orders' , function(){
        return Order::all();
    })->name('orders');
    // Route::get('/welcome' , [WelcomeController::class , 'index']);
    // Route::get('products' , [ProductController::class , 'index']);
    // Route::get('products/{productName}' , [ProductController::class , 'show']);
