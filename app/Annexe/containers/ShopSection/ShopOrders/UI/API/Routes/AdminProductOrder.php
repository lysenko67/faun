<?php

use App\Annexe\containers\ShopSection\ShopOrders\UI\API\Controllers\AdminProductOrderController;

Route::resource('admin/product-order', AdminProductOrderController::class)
    ->only([
        "destroy"
    ]);
