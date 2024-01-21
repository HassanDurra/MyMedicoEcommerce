<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BrandsController;
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
});

