<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;


class ShopCategoryController extends Controller
{
    public function index($slug, ProductRepository $productRepository)
    {
        $category = $productRepository->getCategory($slug);

        $products = $productRepository->getProductOneCategory();

        return view('shop.categories.index', compact('category', 'products'));
    }
}
