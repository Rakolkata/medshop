<?php

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

/*Route::get('/', function () {
    return view('welcome');

});*/
Route::get('/','mainPageController@welcomeindex')->name('welcome');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('profile/{id?}', 'Auth\RegisterController@edit')->name('register.profile');
Route::get('admin/register/profile/{id?}', 'Auth\RegisterController@edit')->name('admin.register.profile');
Route::patch('register/{admin}/update', 'Auth\RegisterController@update')->name('profile.update');

Route::get('changePassword', 'Auth\ResetPasswordController@ShowChangePassword')->name('passwordreset.show');
Route::post('changePassword', 'Auth\ResetPasswordController@UpdatePassword')->name('password.reset');


Route::get('auth/Password/forgotpassword','Auth\ForgotPasswordController@index')->name('forgotpassword');
Route::post('auth/Password/forgotpassword','Auth\ForgotPasswordController@validate_user')->name('validate.forgotpassword');

Route::post('auth/login','Auth\ForgotPasswordController@UpdatePassword')->name('update.forgotpassword');
Route::patch('register/{user}/update', 'Auth\RegisterController@update')->name('profile.update');
Route::post('profile/{id?}', 'Auth\RegisterController@ImageUpload')->name('image.upload');

Route::group(['namespace'=>'Admin'], function(){
Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin-login', 'Auth\LoginController@login');
Route::get('admin/home','HomeController@index')->name('admin.home');
//Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');



Route::post('admin/ChangePassword', 'Auth\ResetPasswordController@UpdatePassword')->name('admin.Change.password');
Route::get('admin.profile/{id?}', 'Auth\RegisterController@edit')->name('profile.register');
Route::patch('admin/register/{user}/update', 'Auth\RegisterController@update')->name('admin.profile.update');Route::post('admin/profile/{id?}', 'Auth\RegisterController@ImageUpload')->name('admin.image.upload');



Route::get('admin/auth/passwords/forgetPassword','Auth\ForgotPasswordController@index')->name('admin.forgotpassword');
Route::post('admin/auth/passwords/forgetPassword','Auth\ForgotPasswordController@validate_user')->name('admin.validate.forgotpassword');
Route::post('admin/auth/login','Auth\ForgotPasswordController@UpdatePassword')->name('admin.update.forgotpassword');
Route::post('admin/auth/passwords/forgetPassword','Auth\ForgotPasswordController@validate_user')->name('admin.validate.forgotpassword');
//product 
Route::get('admin/product','ProductController@create')->name('product.create');
Route::post('admin/productStore','ProductController@store')->name('product.store');
Route::get('admin/productGet','ProductController@getProduct')->name('product.get');
Route::get('admin/productDestroy{id?}','ProductController@deleteProduct')->name('delete.Product');
Route::post('admin/productEdit','ProductController@editProduct')->name('edit.product');
Route::post('admin/productUpdate','ProductController@updateProduct')->name('update.product');
//order
Route::get('admin/order','orderController@create')->name('order.create');
Route::post('admin/orderStore','orderController@store')->name('order.store');
Route::get('admin/orderShow','orderController@show')->name('order.show');
Route::get('admin/orderDestroy{id?}','orderController@Destroy')->name('order.delete');
Route::post('admin/orderEdit','orderController@edit')->name('order.edit');
Route::post('admin/orderUpdate','orderController@update')->name('order.update');
Route::post('admin/orderUpdate','orderController@update')->name('order.update');

//user
Route::get('admin/addCustomer','usercontroller@create')->name('user.create');
Route::post('admin/CustomerStore','usercontroller@store')->name('user.store');
Route::get('admin/Customershow','usercontroller@show')->name('user.show');
Route::get('admin/ustomerDestroy{id?}','usercontroller@delete')->name('user.delete');



});






