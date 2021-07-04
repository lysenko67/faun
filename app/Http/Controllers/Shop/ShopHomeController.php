<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;

class ShopHomeController extends Controller
{
    public function index( ProductRepository $productRepository )
    {
        $products = $productRepository->getProducts();

        return view('shop.home.index', compact('products'));
    }
}
