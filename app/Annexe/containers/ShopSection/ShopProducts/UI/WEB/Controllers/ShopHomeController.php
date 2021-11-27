<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\UI\WEB\Controllers;


use App\Annexe\containers\ShopSection\ShopProducts\Repositories\ProductRepository;
use App\Annexe\containers\ShopSection\ShopProducts\Services\ProductService;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;


class ShopHomeController extends ControllerCore
{


    public function index(ProductService $productService)
    {
        $products = $productService->getProducts();

        return view('shop.home.index', compact('products'));
    }
}
