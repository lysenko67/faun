<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;

class ShopProductController extends Controller
{
    public function index( $category, $slug, ProductRepository $productRepository )
    {
        $product = $productRepository->getOneProduct($slug);

        if(empty($product)) abort(404);

        return view('shop.product.index', ['category' => $product->category, 'product' => $product]);
    }
}
