<?php


use App\Annexe\containers\ShopSection\ShopContacts\UI\WEB\Controllers\ShopContactController;

Route::get('contact', [ShopContactController::class, 'index'])->name('contact.index');
