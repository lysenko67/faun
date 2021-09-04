<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\UI\WEB\Controllers;

use App\Annexe\containers\ShopSection\ShopOrders\Models\Order;
use App\Annexe\containers\ShopSection\ShopOrders\UI\WEB\Requests\OrderRequest;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;
use App\Mail\OrderAccepted;
use App\Services\AddOrders\AddOrders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ShopOrderController extends ControllerCore
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $post = $request->all();

        DB::transaction(function () use ($post, $request) {

            $order = Order::create($post);

            $add_orders = new AddOrders($post, $order);

            $add_orders->create();

//            Mail::to($post['email'])->send(new OrderAccepted($order->id));

        });

        return response()->json($request->all());
    }
}
