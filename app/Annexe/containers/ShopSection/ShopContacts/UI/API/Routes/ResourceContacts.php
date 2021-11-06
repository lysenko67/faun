<?php


use App\Annexe\containers\ShopSection\ShopContacts\UI\API\Controllers\AdminContactController;

Route::resource('admin/contacts', AdminContactController::class)
    ->only([
        "index", "update"
    ]);
