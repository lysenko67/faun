<?php

use App\Annexe\containers\ShopSection\ShopOrders\UI\WEB\Controllers\ShopOrderController;

Route::resource('shop-orders', ShopOrderController::class)
    ->only([
        "store"
    ]);
