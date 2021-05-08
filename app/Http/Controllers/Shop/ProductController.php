<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;


class ProductController extends Controller
{
    protected $fields = [
        'id',
        'title',
        'price',
        'description'
    ];

    public function index($category, $product_id)
    {
        $product = Product::select($this->fields)->find($product_id);

        $product['images'] = $product->images()->where('product_id', $product_id)->get();

        return view('shop.product.index', compact('category', 'product'));
    }
}
