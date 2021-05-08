<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function addToCart($request, $product, $qty = 1)
    {
        $id = $product->id;
        if ($request->session()->has("cart.$id")) {
            $value = $request->session()->get("cart.$id.qty");
            $request->session()->put("cart.$id", [
                'qty' => $value + $qty,
                'title' => $product->title,
                'price' => $product->price,
                'img' => $product->img
            ]);
        } else {
            $request->session()->put("cart.$id", [
                'qty' => $qty,
                'title' => $product->title,
                'price' => $product->price,
                'img' => $product->img
            ]);
        }

        if($request->session()->has('result.qty')) {
            $value = $request->session()->get("result.qty");
            $request->session()->put('result.qty', $value + $qty);
        } else {
            $request->session()->put('result.qty', $qty);
        }

        if($request->session()->has('result.sum')) {
            $value = $request->session()->get("result.sum");
            $request->session()->put('result.sum', $value + $product->price * $qty);
        } else {
            $request->session()->put('result.sum', $product->price * $qty);
        }

        $request->session()->save();
    }

}
