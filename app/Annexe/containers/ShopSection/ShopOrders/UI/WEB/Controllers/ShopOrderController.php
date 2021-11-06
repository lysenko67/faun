<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\UI\WEB\Controllers;

use App\Annexe\containers\ShopSection\ShopOrders\Repositories\OrderRepository;
use App\Annexe\containers\ShopSection\ShopOrders\Services\AddOrders;
use App\Annexe\containers\ShopSection\ShopOrders\UI\WEB\Requests\OrderRequest;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;
use App\Mail\OrderAccepted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ShopOrderController extends ControllerCore
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
//        DB::transaction();

        $post = $request->all();

        $order = $this->orderRepository->createOrder($post);

        $add_orders = new AddOrders($post, $order);

        $res = $add_orders->create();

        if ($res) {
//            Mail::to($post['email'])->send(new OrderAccepted($order->id));
            return redirect()->route('order.show', ['id' => $order->id]);
        } else {
            return response()->json('Произошла ошибка, попробуйте ещё раз!');
        }

//        DB::commit();

    }

}
