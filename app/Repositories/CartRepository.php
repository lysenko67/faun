<?php

namespace App\Repositories;


class CartRepository
{
    public function addToCart($product, $qty_product = 1)
    {
        $id = $product['id'];
        if (session()->has("cart.$id")) {
            $value = session()->get("cart.$id.qty_product");
            session()->put("cart.$id", [
                'id' => $id,
                'qty_product' => $value + $qty_product,
                'price' => $product['price'] * ($value + $qty_product),
                'product_slug' => $product['slug'],
                'category_slug' => $product['category']['slug'],
                'title' => $product['title'],
                'img' => $product['images']
            ]);
        } else {
            session()->put("cart.$id", [
                'id' => $id,
                'qty_product' => $qty_product,
                'price' => $product['price'],
                'product_slug' => $product['slug'],
                'category_slug' => $product['category']['slug'],
                'title' => $product['title'],
                'img' => $product['images']
            ]);
        }

        if(session()->has('result.qty')) {
            $value = session()->get("result.qty");
            session()->put('result.qty', $value + $qty_product);
        } else {
            session()->put('result.qty', $qty_product);
        }

        if(session()->has('result.sum')) {
            $value = session()->get("result.sum");
            session()->put('result.sum', $value + $product['price'] * $qty_product);
        } else {
            session()->put('result.sum', $product['price'] * $qty_product);
        }

        session()->save();
    }

}
