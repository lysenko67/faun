<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\UI\WEB\Controllers;

use App\Annexe\containers\ShopSection\ShopOrders\Repositories\OrderRepository;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;
use Illuminate\Http\Request;

class ShopOneOrderController extends ControllerCore
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function show(Request $request)
    {
//        $this->orderRepository->getOneOrder($request->get('id'));
        $id = $request->get('id');

        return view('shop.cart.order', compact('id'));
    }

}
