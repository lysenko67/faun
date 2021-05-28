<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function addToCart($request, $product, $qty_product = 1)
    {
        $id = $product->id;
        if ($request->session()->has("cart.$id")) {
//            dd($request->session());
            $value = $request->session()->get("cart.$id.qty_product");
//            $value_price = $request->session()->get("cart.$id.price");
            $request->session()->put("cart.$id", [
                'id' => $id,
                'qty_product' => $value + $qty_product,
                'price' => $product->price * ($value + $qty_product),
                'product_slug' => $product->slug,
                'category_slug' => $product->category->slug,
                'title' => $product->title,
                'img' => $product->img
            ]);
        } else {
            $request->session()->put("cart.$id", [
                'id' => $id,
                'qty_product' => $qty_product,
                'price' => $product->price,
                'product_slug' => $product->slug,
                'category_slug' => $product->category->slug,
                'title' => $product->title,
                'img' => $product->img
            ]);
        }

        if($request->session()->has('result.qty')) {
            $value = $request->session()->get("result.qty");
            $request->session()->put('result.qty', $value + $qty_product);
        } else {
            $request->session()->put('result.qty', $qty_product);
        }

        if($request->session()->has('result.sum')) {
            $value = $request->session()->get("result.sum");
            $request->session()->put('result.sum', $value + $product->price * $qty_product);
        } else {
            $request->session()->put('result.sum', $product->price * $qty_product);
        }

        $request->session()->save();
    }

}
