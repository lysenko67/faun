<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
//    protected $fields = [
//        'id',
//        'title',
//        'price',
//        'description'
//    ];


    public function index($category, $slug)
    {
        $product = Product::where('slug', $slug)->get()[0];
        $product['images'] = $product->images()->where('product_id', $product->id)->get();
        $category = $product->category;

        return view('shop.product.index', compact('category',  'product'));
    }
}
