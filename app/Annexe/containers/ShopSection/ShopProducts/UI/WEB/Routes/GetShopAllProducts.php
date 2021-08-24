<?php

use App\Annexe\containers\ShopSection\ShopProducts\UI\WEB\Controllers\ShopHomeController;

Route::get('/', ShopHomeController::class . '@index')->name('home');

