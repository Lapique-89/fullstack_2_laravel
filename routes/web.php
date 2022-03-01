<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;
 
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', "App\Http\Controllers\AdminController@admin")->name('admin');
    Route::get('/users', [AdminController::class, 'users'])->name('adminUsers');
    

    Route::get('/enterAsUser/{id}', [AdminController::class, 'enterAsUser'])->name('enterAsUser');

    Route::get('/categories', [AdminController::class, 'categories'])->name('adminCategories');
    Route::post('/exportCategories', [AdminController::class, 'exportCategories'])->name('exportCategories');
    Route::post('/importCategories', [AdminController::class, 'importCategories'])->name('importCategories');
    Route::post('/addCategory', [AdminController::class, 'addCategory'])->name('addCategory');
    Route::post('/deleteCategory/{id}', [AdminController::class, 'deleteCategory'])->name('deleteCategory');
     Route::get('/getCategory/{id}', [AdminController::class, 'getcategory'])->name('getCategory');
    Route::post('/updateCategory', [AdminController::class, 'updateCategory'])->name('updateCategory'); 

    Route::get('/products', [AdminController::class, 'products'])->name('adminProducts');
    Route::get('/getProduct/{id}', [AdminController::class, 'getProduct'])->name('getProduct');
    Route::post('/updateProduct', [AdminController::class, 'updateProduct'])->name('updateProduct'); 
    Route::post('/deleteProduct/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');
    
    Route::post('/exportProducts', [AdminController::class, 'exportProducts'])->name('exportProducts');
    Route::post('/importProducts', [AdminController::class, 'importProducts'])->name('importProducts');
    Route::post('/addProduct', [AdminController::class, 'addProduct'])->name('addProduct');

    Route::prefix('roles')->group(function() {
        Route::post('/add', [AdminController::class, 'addRole'])->name('addRole');
        Route::post('/addRoleToUser', [AdminController::class, 'addRoleToUser'])->name('addRoleToUser');
    
});

    });
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'cart'])->name('cart');
    Route::post('/removeFromCart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/createOrder', [CartController::class, 'createOrder'])->name('createOrder');
    Route::get('/orders', [CartController::class, 'orders'])->name('orders');
});
Route::post('/RepeatCart', [CartController::class, 'RepeatCart'])->name('RepeatCart');
Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');
Route::get('/category/{category}/getProducts', [HomeController::class, 'getProducts']);
Route::get('/profile/{user}', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/save', [ProfileController::class, 'save'])->name('saveProfile');
Route::get('/profile/{user}/getAddress', [ProfileController::class, 'getAddress']);
//Route::get('/home',[HomeController::class, 'index'])->name('home');

Auth::routes();
