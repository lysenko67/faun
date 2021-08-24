<?php

namespace App\Annexe\containers\ShopSection\ShopCategories\UI\WEB\Controllers;

use App\Annexe\containers\ShopSection\ShopCategories\Repositories\CategoryRepository;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;
use App\Repositories\ProductRepository;


class ShopCategoryController extends ControllerCore
{
    private $categoryRepository;

    /**
     * AdminOrdersController constructor.
     * @var categoryRepository
     */
    public function __construct()
    {
        $this->shopCategoryRepository = app(categoryRepository::class);
    }

    public function index($slug, ProductRepository $productRepository)
    {
        $category = $productRepository->getCategory($slug);

        $products = $productRepository->getProductOneCategory();

        return view('shop.categories.index', compact('category', 'products'));
    }
}
