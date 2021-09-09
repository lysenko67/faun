<?php

use \App\Annexe\containers\ShopSection\ShopCategories\UI\WEB\Controllers\ShopCategoryController;

Route::get('/category{category}', ShopCategoryController::class . '@index')->name('category.index');
