<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cart = session()->get('cart');
        return view('shop.cart.index', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return false
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $product = Product::find($data['id']);
        $images = $product->images()->where('product_id', $data['id'])->get()->all();
        $img = array_shift($images);
        $product['img'] = $img->img;
        if(empty($product)) return false;

        $qty = 1;
        $cart = new Cart();
        $cart->addToCart($request, $product, $qty);

        $result = session()->get('result');
        $product = session()->get('cart.'.$data['id']);

        return response()->json([
            'result' => $result['sum'],
            'qty' => $result['qty'],
            'qty_product' => $product['qty_product'],
            'price' => $product['price']
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $price = Product::find($id)->price;

        $result = session()->get('result');
        $result['qty'] = $result['qty'] - 1;
        $result['sum'] = $result['sum'] - $price;
        $request->session()->put('result', $result);
        $result = session()->get('result');

        $prod = session()->get("cart.$id");

        $prod['qty_product'] = $prod['qty_product'] - 1;
        $prod['price'] = $prod['price'] - $price;
        $request->session()->put("cart.$id", $prod);
        $prod = session()->get("cart.$id");

        if($prod['qty_product'] < 1) {
            $request->session()->forget("cart.$id");
        }

        return response()->json([
            'result' => $result['sum'],
            'qty' => $result['qty'],
            'qty_product' => $prod['qty_product'],
            'price' => $prod['price']
        ], JsonResponse::HTTP_OK);
    }
}
