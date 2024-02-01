<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductController;
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

Route::get('admin/login' , [AuthController::class ,'admin_login'])->name('admin.login.view');
Route::get('admin/register' , [AuthController::class ,'admin_register'])->name('admin.register.view');
Route::Post('login' , [AuthController::class ,'login'])->name('auth.login');
Route::Post('registered' , [AuthController::class ,'register'])->name('auth.register');
Route::get('/email/verified/{id?}' , [AuthController::class , 'verify_email_address'])->name("auth.email.verify");
Route::prefix("admin/")->middleware(['admin'])->group(function(){
    Route::get('logout' ,[AuthController::class , 'admin_logout'])->name('admin.logout');
    Route::get('dashboard' , [DashboardController::class ,'index'])->name('admin.dashboard');
    Route::get('notification' , [DashboardController::class ,'check_notification'])->name('admin.notification');
    Route::get('delete/notification/{id?}' , [NotificationController::class ,'destroy'])->name('delete.notification');
    // Brands
    Route::prefix('brands/')->group(function(){
        Route::get('/all' , [BrandsController::class,'index'])->name('brands.index');
        Route::get('/trash' , [BrandsController::class,'trash'])->name('brands.trash');
        Route::get('create/{id?}' , [BrandsController::class,'create'])->name('brands.create');
        Route::Post('store/' , [BrandsController::class,'store'])->name('brands.store');
        Route::Post('update/{id?}' , [BrandsController::class,'update'])->name('brands.update');
        Route::get('delete/{id?}' , [BrandsController::class,'delete'])->name('brands.delete');
        Route::get('restore/{id?}' , [BrandsController::class,'restore'])->name('brands.restore');
        Route::get('destroy/{id?}' , [BrandsController::class,'destroy'])->name('brands.destroy');
    });
    // Catgories
    Route::prefix('category/')->group(function(){
        Route::get('/all' , [CategoryController::class,'index'])->name('category.index');
        Route::get('/trash' , [CategoryController::class,'trash'])->name('category.trash');
        Route::get('create/{id?}' , [CategoryController::class,'create'])->name('category.create');
        Route::Post('store/{id?}' , [CategoryController::class,'store'])->name('category.store');
        Route::get('delete/{id?}' , [CategoryController::class,'delete'])->name('category.delete');
        Route::get('restore/{id?}' , [CategoryController::class,'restore'])->name('category.restore');
        Route::get('destroy/{id?}' , [CategoryController::class,'destroy'])->name('category.destroy');
    });
    // Catgories
    Route::prefix('subcategory/')->group(function(){
        Route::get('/all' , [SubCategoryController::class,'index'])->name('subcategory.index');
        Route::get('/trash' , [SubCategoryController::class,'trash'])->name('subcategory.trash');
        Route::get('create/{id?}' , [SubCategoryController::class,'create'])->name('subcategory.create');
        Route::Post('store/{id?}' , [SubCategoryController::class,'store'])->name('subcategory.store');
        Route::get('delete/{id?}' , [SubCategoryController::class,'delete'])->name('subcategory.delete');
        Route::get('restore/{id?}' , [SubCategoryController::class,'restore'])->name('subcategory.restore');
        Route::get('destroy/{id?}' , [SubCategoryController::class,'destroy'])->name('subcategory.destroy');
    });
    // Products
    Route::prefix('product/')->group(function(){
        Route::get('/all' , [ProductController::class,'index'])->name('product.index');
        Route::get('/trash' , [ProductController::class,'trash'])->name('product.trash');
        Route::get('create/{id?}' , [ProductController::class,'create'])->name('product.create');
        Route::get('publish/{id?}' , [ProductController::class,'publish'])->name('product.publish');
        Route::Post('store/{id?}' , [ProductController::class,'store'])->name('product.store');
        Route::Post('update/{id?}' , [ProductController::class,'update'])->name('product.update');
        Route::get('delete/{id?}' , [ProductController::class,'delete'])->name('product.delete');
        Route::get('restore/{id?}' , [ProductController::class,'restore'])->name('product.restore');
        Route::get('destroy/{id?}' , [ProductController::class,'destroy'])->name('product.destroy');
        Route::get('subcategory/{id?}' , [ProductController::class,'subcategory'])->name('product.subcategory');
    });
});

