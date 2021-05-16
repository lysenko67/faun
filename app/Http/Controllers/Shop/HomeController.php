<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;


class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
//        dd($products);
        return view('shop.home.index', compact('products'));
    }
}
