<?php

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
    Route::resource('/orders', 'OrderController' );
    Route::resource('/categories', 'CategoryController');
    Route::resource('/products', 'ProductController');
    Route::resource('products/files', 'FileController');
});

Route::group(['namespace' => '\App\Http\Controllers\Shop'], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('cart', 'CartController');
    Route::get('/{category}', 'CategoryController@index')->name('category.index');
    Route::get('/{category}/{slug}', 'ProductController@index')->name('product.index');
});



