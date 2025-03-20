<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\FunctionController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\ProductVeriantController;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



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
    return view('auth.login');
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
    // Route::get('/admin/category/data', [CategoryController::class, 'cat_data'])->name('admin.cat_data');
    Route::get('/admin/category/search',[CategoryController::class, 'search'])->name('admin.category_search');

    Route::get('/admin/view/brand', [BrandController::class, 'view'])->name('admin.view_brand');
    Route::get('/admin/add/brand', [BrandController::class, 'index'])->name('admin.add_brand');
    Route::post('/admin/store/brand', [BrandController::class, 'store'])->name('admin.store_brand');
    Route::get('/admin/delete/brand/{id}', [BrandController::class, 'delete'])->name('admin.delete_brand');
    Route::get('/admin/edit/brand/{id}', [BrandController::class, 'edit'])->name('admin.edit_brand');
    Route::post('/admin/update/brand/{id}', [BrandController::class, 'update'])->name('admin.update_brand');
    Route::get('/admin/brand/data', [BrandController::class, 'brand_data'])->name('admin.brand_data');


    Route::get('/admin/view/function', [FunctionController::class, 'view'])->name('admin.view_function');
    Route::get('/admin/add/function', [FunctionController::class, 'index'])->name('admin.add_function');
    Route::post('/admin/store/function', [FunctionController::class, 'store'])->name('admin.store_function');
    Route::get('/admin/delete/function/{id}', [FunctionController::class, 'delete'])->name('admin.delete_function');
    Route::get('/admin/edit/function/{id}', [FunctionController::class, 'edit'])->name('admin.edit_function');
    Route::post('/admin/update/function/{id}', [FunctionController::class, 'update'])->name('admin.update_function');
    Route::get('/admin/function/data', [FunctionController::class, 'function_data'])->name('admin.function_data');
    

    Route::get('/admin/view/schedule', [ScheduleController::class, 'view'])->name('admin.view_schedule');
    Route::get('/admin/add/schedule', [ScheduleController::class, 'index'])->name('admin.add_schedule');
    Route::post('/admin/store/schedule', [ScheduleController::class, 'store'])->name('admin.store_schedule');
    Route::get('/admin/delete/schedule/{id}', [ScheduleController::class, 'delete'])->name('admin.delete_schedule');
    Route::get('/admin/edit/schedule/{id}', [ScheduleController::class, 'edit'])->name('admin.edit_schedule');
    Route::post('/admin/update/schedule/{id}', [ScheduleController::class, 'update'])->name('admin.update_schedule');



    Route::get('/admin/view/product', [ProductController::class, 'view'])->name('admin.view_product');
    Route::get('/admin/add/product', [ProductController::class, 'index'])->name('admin.add_product');
    Route::post('/admin/store/product', [ProductController::class, 'store'])->name('admin.store_product');
    Route::get('/admin/delete/product/{id}', [ProductController::class, 'delete'])->name('admin.delete_product');
    Route::post('/admin/product/excel', [ProductController::class, 'importData'])->name('admin.product_exel_import');
    Route::get('/admin/edit/product/{id}', [ProductController::class, 'edit'])->name('admin.edit_product');
    Route::post('/admin/update/product/{id}', [ProductController::class, 'update'])->name('admin.update_product');
    Route::get('/admin/update/product/{id}/veriant', [ProductVeriantController::class, 'update'])->name('admin.update_product_veriant');
    Route::post('/admin/update/product/{id}/save', [ProductVeriantController::class, 'save'])->name('admin.update_product_veriant_save');
    Route::get('/admin/incoming_invoice', [ProductController::class, 'incoming_invoice'])->name('admin.incoming_invoice');
    Route::get('/admin/incoming_invoice_list', [ProductController::class, 'incoming_invoice_list'])->name('admin.incoming_invoice_list');
    Route::post('/admin/incoming_invoice_store', [ProductController::class, 'incoming_invoice_store'])->name('admin.incoming_invoice_store');




    Route::get('/admin/create/order', [OrderController::class, 'index'])->name('admin.craete_order');
    Route::get('/admin/product/name', [OrderController::class, 'prod_name'])->name('admin.prod_name');
    Route::get('/admin/product/details', [OrderController::class, 'prod_details'])->name('admin.prod_details');
    Route::post('/admin/order/store', [OrderController::class, 'store'])->name('admin.order_store');
    Route::get('/admin/order-list', [OrderController::class, 'view'])->name('admin.order_view');
    Route::get('/admin/order-details/{Order_id}', [OrderController::class, 'order_details'])->name('admin.order_details');
    Route::get('/admin/order/delete/{id}', [OrderController::class, 'delete'])->name('admin.order_delete');
    Route::get('/admin/genpdf', [OrderController::class, 'genpdf'])->name('admin.genpdf');
    Route::get('/admin/order/customer_data', [OrderController::class, 'customer_data'])->name('admin.customer_data');

    Route::get('/admin/reports', [ReportsController::class, 'index'])->name('admin.reports');
    Route::post('/admin/reports/export', [ReportsController::class, 'export'])->name('admin.reports_exports');
    Route::post('/admin/reports/export/excel', [ReportsController::class, 'report'])->name('admin.reports_exports_excel');
    Route::post('/admin/reports/upcoming_exp_product', [HomeController::class, 'upexp'])->name('admin.report_recentexpairy');
    Route::get('/admin/reports/upcoming_exp_product', [HomeController::class, 'upexp'])->name('admin.report_recentexpairy');
    Route::get('/admin/reports/less_stock_product', [HomeController::class, 'lessstock'])->name('admin.report_lessstock');
    Route::post('/admin/reports/less_stock_product', [HomeController::class, 'lessstock'])->name('admin.report_lessstock');
    Route::get('/admin/reports/gst_report', [ReportsController::class, 'gst_report'])->name('admin.gst_report');
    Route::post('/admin/reports/gst_report_export', [ReportsController::class, 'gst_report_export'])->name('admin.gst_report_export');
    
 
 

    Route::get('/order/search', [OrderController::class, 'serch_order'])->name('admin.order_search');


    Route::get('/admin/product/search', [ProductController::class, 'search'])->name('search');

 
    Route::view('/search', 'search');

    Route::get('/admin/order/status/{id}',[OrderController::class, 'status_update'] )->name('cahnge_status');

    Route::get('/admin/order/cancle/{id}',[OrderController::class, 'cancle_order'])->name('order_cancle'); 
    Route::get('/admin/order/complete-cancle/{id}',[OrderController::class, 'cancle_complete_order'])->name('complete_order_cancle'); 

});


Route::middleware(['auth', 'user-access:shopowner'])->group(function () {

    Route::get('/shopowner/home', [HomeController::class, 'shopownerHome'])->name('shopowner.home');
});
