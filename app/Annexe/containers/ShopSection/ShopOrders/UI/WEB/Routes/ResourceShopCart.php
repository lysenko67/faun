<?php

use App\Annexe\containers\ShopSection\ShopOrders\UI\WEB\Controllers\ShopCartController;

Route::delete('cart/{id}/{qty}/{sum}', ShopCartController::class.'@customDestroy');

Route::resource('cart', ShopCartController::class);
