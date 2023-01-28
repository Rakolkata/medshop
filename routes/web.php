<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\FunctionController;
use App\Http\Controllers\Admin\ScheduleController; 
use App\Http\Controllers\Admin\ProductController;




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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'registration_success'])->name('home');




Route::middleware(['auth', 'user-access:shopkeepar'])->group(function () {
  
    Route::get('/shopkeepar/home', [HomeController::class, 'index'])->name('shopkeepar.home');
});


Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::get('/admin/view/category', [CategoryController::class, 'view'])->name('admin.view_category');
    Route::get('/admin/add/category', [CategoryController::class, 'index'])->name('admin.add_category');
    Route::post('/admin/store/category', [CategoryController::class, 'store'])->name('admin.store_category');
    Route::get('/admin/delete/category/{id}', [CategoryController::class, 'delete'])->name('admin.delete_category');
    Route::get('/admin/edit/category/{id}', [CategoryController::class, 'edit'])->name('admin.edit_category');
    Route::post('/admin/update/category/{id}', [CategoryController::class, 'update'])->name('admin.update_category');

    Route::get('/admin/view/brand', [BrandController::class, 'view'])->name('admin.view_brand');
    Route::get('/admin/add/brand', [BrandController::class, 'index'])->name('admin.add_brand');
    Route::post('/admin/store/brand', [BrandController::class, 'store'])->name('admin.store_brand');
    Route::get('/admin/delete/brand/{id}', [BrandController::class, 'delete'])->name('admin.delete_brand');

    Route::get('/admin/view/function', [FunctionController::class, 'view'])->name('admin.view_function');
    Route::get('/admin/add/function', [FunctionController::class, 'index'])->name('admin.add_function');
    Route::post('/admin/store/function', [FunctionController::class, 'store'])->name('admin.store_function');
    Route::get('/admin/delete/function/{id}', [FunctionController::class, 'delete'])->name('admin.delete_function');

    Route::get('/admin/view/schedule', [ScheduleController::class, 'view'])->name('admin.view_schedule');
    Route::get('/admin/add/schedule', [ScheduleController::class, 'index'])->name('admin.add_schedule');
    Route::post('/admin/store/schedule', [ScheduleController::class, 'store'])->name('admin.store_schedule');
    Route::get('/admin/delete/schedule/{id}', [ScheduleController::class, 'delete'])->name('admin.delete_schedule');

    Route::get('/admin/view/product', [ProductController::class, 'view'])->name('admin.view_product');
    Route::get('/admin/add/product', [ProductController::class, 'index'])->name('admin.add_product');
    Route::post('/admin/store/product', [ProductController::class, 'store'])->name('admin.store_product');
    Route::get('/admin/delete/product/{id}', [ProductController::class, 'delete'])->name('admin.delete_product');



















});


Route::middleware(['auth', 'user-access:shopowner'])->group(function () {
  
    Route::get('/shopowner/home', [HomeController::class, 'shopownerHome'])->name('shopowner.home');
});
