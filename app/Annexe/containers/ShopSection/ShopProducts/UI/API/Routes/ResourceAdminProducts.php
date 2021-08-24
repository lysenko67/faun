<?php

use App\Annexe\containers\ShopSection\ShopProducts\UI\API\Controllers\AdminProductController;

Route::resource('admin/products', AdminProductController::class)
    ->only([
        "index", "store", "show", "update", "destroy",
    ]);







