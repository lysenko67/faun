<?php

use App\Annexe\containers\ShopSection\ShopOrders\UI\API\Controllers\AdminOrderController;

Route::resource('admin/orders', AdminOrderController::class)
    ->only([
        "index", "store", "show", "update", "destroy",
    ]);;




