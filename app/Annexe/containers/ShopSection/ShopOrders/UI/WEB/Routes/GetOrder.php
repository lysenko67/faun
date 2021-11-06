<?php


use App\Annexe\containers\ShopSection\ShopOrders\UI\WEB\Controllers\ShopOneOrderController;

Route::get('order', [ShopOneOrderController::class, 'show'])->name('order.show');
