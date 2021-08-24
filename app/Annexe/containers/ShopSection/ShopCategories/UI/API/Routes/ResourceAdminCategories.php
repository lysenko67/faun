<?php

use App\Annexe\containers\ShopSection\ShopCategories\UI\API\Controllers\AdminCategoryController;

Route::resource('admin/categories', AdminCategoryController::class)
        ->only([
            "index", "store", "show", "update", "destroy",
        ]);




