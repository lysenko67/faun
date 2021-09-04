<?php

use App\Annexe\containers\ShopSection\ShopOrders\UI\WEB\Controllers\ShopOrderController;

Route::resource('orders', ShopOrderController::class)
    ->only([
        "store"
    ]);
