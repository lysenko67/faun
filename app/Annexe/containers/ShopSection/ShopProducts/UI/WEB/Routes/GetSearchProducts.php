<?php

use App\Annexe\containers\ShopSection\ShopProducts\UI\WEB\Controllers\ShopSearchController;

Route::post('search', ShopSearchController::class . '@index');
