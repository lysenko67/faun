<?php

use App\Annexe\containers\ShopSection\ShopAbout\UI\WEB\Controllers\ShopAboutController;

Route::get('about', ShopAboutController::class . '@index')->name('about.index');
