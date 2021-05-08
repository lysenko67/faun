<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;


class CategoryController extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $products = Product::where('category_id', $category->id)->paginate(3);

        return view('shop.categories.index', compact('category', 'products'));
    }
}
