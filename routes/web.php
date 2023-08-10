<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',[\App\Http\Controllers\Front\HomeController::class,'index']);

Route::prefix("/shop")->group(function () {
    Route::get('/',[\App\Http\Controllers\Front\ShopController::class,'index']);
    Route::get('/detail/{id}',[\App\Http\Controllers\Front\ShopController::class,'detail']);
    Route::get('/wishlist',[\App\Http\Controllers\Front\ShopController::class,'wishlist']);
});

Route::prefix("/blog")->group(function () {
    Route::get('/',[\App\Http\Controllers\Front\BlogController::class,'index']);
    Route::get('/detail',[\App\Http\Controllers\Front\BlogController::class,'show']);

});

Route::prefix("/contact")->group(function () {
    Route::get('/',[\App\Http\Controllers\Front\ContactController::class,'index']);
});

 Route::prefix('admin')->group(function (){
     Route::get('dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index']);
     Route::get('/statistical',[\App\Http\Controllers\Admin\DashboardController::class,'statistical']);
     Route::get('/order7Days',[\App\Http\Controllers\Admin\DashboardController::class,'order7Days']);
     Route::prefix('category')->group(function (){
         Route::get('',[\App\Http\Controllers\Admin\ProductCategoryController::class,'index']);
         Route::get('create',[\App\Http\Controllers\Admin\ProductCategoryController::class,'create']);
         Route::post('store',[\App\Http\Controllers\Admin\ProductCategoryController::class,'store']);
         Route::post('action',[\App\Http\Controllers\Admin\ProductCategoryController::class,'action']);
         Route::get('edit/{id}',[\App\Http\Controllers\Admin\ProductCategoryController::class,'edit']);
         Route::post('edit/update/{id}',[\App\Http\Controllers\Admin\ProductCategoryController::class,'update']);
         Route::get('delete/{id}',[\App\Http\Controllers\Admin\ProductCategoryController::class,'delete']);
     });



     Route::prefix('login')->group(function (){
         Route::get('',[\App\Http\Controllers\Admin\HomeController::class,'getLogin'])->withoutMiddleware('CheckAdminLogin');
         Route::post('',[\App\Http\Controllers\Admin\HomeController::class,'postLogin'])->withoutMiddleware('CheckAdminLogin');
     });
     Route::get('logout',[\App\Http\Controllers\Admin\HomeController::class,'logout']);

 });

Route::prefix('category')->group(function (){
    Route::get('',[\App\Http\Controllers\Admin\ProductCategoryController::class,'index']);

    Route::post('store',[\App\Http\Controllers\Admin\ProductCategoryController::class,'store']) ;
    Route::post('action',[\App\Http\Controllers\Admin\ProductCategoryController::class,'action'])->can('category.view');
    Route::get('edit/{id}',[\App\Http\Controllers\Admin\ProductCategoryController::class,'edit'])->name('category.edit')->can('category.edit');
    Route::post('edit/update/{id}',[\App\Http\Controllers\Admin\ProductCategoryController::class,'update'])->name('category.update')->can('category.edit');
    Route::get('delete/{id}',[\App\Http\Controllers\Admin\ProductCategoryController::class,'delete'])->name('delete_category')->can('category.delete');

});


Route::prefix('/cart')->group(function (){
    Route::get('/',[\App\Http\Controllers\Front\CartController::class,'index']);
    Route::get('add/{id}', [\App\Http\Controllers\Front\CartController::class, 'add']);
;
});


Route::prefix('/checkout')->group(function (){
    Route::get('/',[\App\Http\Controllers\Front\CheckoutController::class,'index']);
});

Route::prefix('account')->group(function () {
    Route::get('my-account',[\App\Http\Controllers\Front\AccountController::class,'myAccount']);
    Route::get('login',[\App\Http\Controllers\Front\AccountController::class,'login']);
    Route::post('login',[\App\Http\Controllers\Front\AccountController::class,'checkLogin']);
    Route::get('register',[\App\Http\Controllers\Front\AccountController::class,'register']);
    Route::get('logout',[\App\Http\Controllers\Front\AccountController::class,'logout']);
});
Route::prefix('/review')->group(function (){
    Route::get('/{orderDetail:order_code}',[\App\Http\Controllers\Front\ReviewController::class,'index']);
    Route::post('/store',[\App\Http\Controllers\Front\ReviewController::class,'store']);
});

