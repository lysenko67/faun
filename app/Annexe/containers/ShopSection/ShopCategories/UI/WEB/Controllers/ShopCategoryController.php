<?php

namespace App\Annexe\containers\ShopSection\ShopCategories\UI\WEB\Controllers;

use App\Annexe\containers\ShopSection\ShopCategories\Repositories\CategoryRepository;
use App\Annexe\containers\ShopSection\ShopProducts\Repositories\ProductRepository;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;



class ShopCategoryController extends ControllerCore
{
    private $categoryRepository;
    private $productRepository;

    /**
     * AdminOrdersController constructor.
     * @var categoryRepository
     */
    public function __construct()
    {
        $this->categoryRepository = app(categoryRepository::class);
        $this->productRepository = app(productRepository::class);
    }

    public function index($slug)
    {
        $category = $this->categoryRepository->getCategory($slug);

        $products = $this->productRepository->getAllProductsOnlyCategory($category['id'], 10);

        return view('shop.categories.index',
            [
                'category' => $category['title'],
                'products' => $products
            ]);
    }
}
