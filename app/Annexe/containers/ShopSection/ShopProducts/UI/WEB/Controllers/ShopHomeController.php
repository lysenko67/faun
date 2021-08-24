<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\UI\WEB\Controllers;


use App\Annexe\containers\ShopSection\ShopProducts\Repositories\ProductRepository;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;


class ShopHomeController extends ControllerCore
{


    public function index( ProductRepository $productRepository )
    {
        $products = $productRepository->getAllProducts();

        return view('shop.home.index', compact('products'));
    }
}
