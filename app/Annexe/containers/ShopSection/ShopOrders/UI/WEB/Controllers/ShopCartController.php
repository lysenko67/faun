<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\UI\WEB\Controllers;

use App\Annexe\containers\ShopSection\ShopOrders\Repositories\CartRepository;
use App\Annexe\containers\ShopSection\ShopProducts\Models\Product;
use App\Annexe\containers\ShopSection\ShopProducts\Repositories\ProductRepository;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopCartController extends ControllerCore
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return false
     */
    public function store(Request $request, ProductRepository $productRepository)
    {
        $data = $request->json()->all();
        $product = $productRepository->getCartProduct($data['payload']['id']);
//        return response()->json($data['payload']['heightSm']);

        $qty = 1;
        $cart = new CartRepository();
        $cart->addToCart($product, $qty, $data['payload']['heightSm']);

        $result = session()->get('result');
        $product = session()->get('cart.'.$data['payload']['id']);

        return response()->json([
            'result' => $result['sum'],
            'qty' => $result['qty'],
            'qty_product' => $product['qty_product'],
            'heightSm' => $data['payload']['heightSm'],
            'price' => $product['price']
        ], JsonResponse::HTTP_OK);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customDestroy($id, $qty, $sum)
    {
        $result = session()->get('result');

        $result['qty'] = $result['qty'] - $qty;
        $result['sum'] = $result['sum'] - $sum;
        session()->put('result', $result);
        $result = session()->get('result');

        session()->forget("cart.$id");
        $cart = session()->get('cart');

        return response()->json([
            'cart' => $cart,
            'result' => $result
        ], JsonResponse::HTTP_OK);
    }
}
