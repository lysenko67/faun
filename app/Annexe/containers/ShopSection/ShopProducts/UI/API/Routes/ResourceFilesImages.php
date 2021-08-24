<?php

use \App\Annexe\containers\ShopSection\ShopProducts\UI\API\Controllers\AdminFileController;

Route::resource('admin/files', AdminFileController::class)
    ->only([
        "destroy",
    ]);
