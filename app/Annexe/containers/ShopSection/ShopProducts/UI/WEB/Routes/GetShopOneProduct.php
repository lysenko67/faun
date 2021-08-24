<?php

use App\Annexe\containers\ShopSection\ShopProducts\UI\WEB\Controllers\ShopProductController;

Route::get('/{category}/{slug}', ShopProductController::class . '@index')->name('product.index');
