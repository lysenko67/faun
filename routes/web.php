<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminFileController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Shop\ShopCartController;
use App\Http\Controllers\Shop\ShopCategoryController;
use App\Http\Controllers\Shop\ShopContactController;
use App\Http\Controllers\Shop\ShopHomeController;
use App\Http\Controllers\Shop\ShopOrderController;
use App\Http\Controllers\Shop\ShopProductController;
use App\Http\Controllers\UserController;
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
Route::group(['namespace' => '\App\Http\Controllers'], function() {
    Route::get('login', 'UserController@loginForm')->name('login.create');
    Route::post('login', 'UserController@login')->name('login');
});

Route::get('logout', '\App\Http\Controllers\UserController@logout')->name('logout')->middleware('auth');

Route::group(['prefix' => 'admin', 'namespace' => '\App\Http\Controllers\Admin', 'middleware' => 'admin'], function() {
    Route::resource('orders', 'AdminOrderController' );
    Route::resource('categories', 'AdminCategoryController');
    Route::resource('products', 'AdminProductController');
    Route::get('edit-contacts', 'AdminContactController@index')->name('edit-contacts');
    Route::resource('products/files', 'AdminFileController');
});

Route::group(['namespace' => '\App\Http\Controllers\Shop'], function() {
    Route::get('/', 'ShopHomeController@index')->name('home');
    Route::post('orders', 'ShopOrderController@store')->name('orders');
    Route::get('contacts', 'ShopContactController@index')->name('contacts.index');
    Route::delete('cart/{id}/{qty}/{sum}', 'ShopCartController@customDestroy');
    Route::resource('cart', 'ShopCartController');
    Route::get('/{category}', 'ShopCategoryController@index')->name('category.index');
    Route::get('/{category}/{slug}', 'ShopProductController@index')->name('product.index');
});



