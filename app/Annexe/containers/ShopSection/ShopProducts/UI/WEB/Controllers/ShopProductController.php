<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\UI\WEB\Controllers;

use App\Annexe\containers\ShopSection\ShopProducts\Repositories\ProductRepository;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;


class ShopProductController extends ControllerCore
{
    public function index( $category, $slug, ProductRepository $productRepository )
    {
        $product = $productRepository->getOneProduct($slug);

        if(empty($product)) abort(404);

        return view('shop.product.index', ['category' => $product->category, 'product' => $product]);
    }
}
