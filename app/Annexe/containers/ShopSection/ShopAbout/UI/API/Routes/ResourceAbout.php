<?php

use App\Annexe\containers\ShopSection\ShopAbout\UI\WEB\Controllers\ShopAboutController;

Route::resource('about', ShopAboutController::class)
    ->only([
        "index", "update"
    ]);
