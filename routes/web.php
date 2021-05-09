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

Route::group(['prefix' => 'admin', 'namespace' => '\App\Http\Controllers\Admin'], function() {
    Route::get('/', 'MainController@index')->name('admin.index');
    Route::resource('/categories', 'CategoryController');
});

Route::group(['namespace' => '\App\Http\Controllers\Shop'], function() {
    Route::get('/', 'HomeController@index');
    Route::resource('cart', 'CartController');
    Route::get('/{category}', 'CategoryController@index')->name('category.index');
    Route::get('/{category}/{product_id}', 'ProductController@index')->name('product.index');
});


