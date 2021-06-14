<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\OrderAccepted;
use App\Models\Order;
use App\Services\AddOrders\AddOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
//        $validated = $request->validate([
//            'phone' => 'required',
//        ]);

        return;

        $post = $request->all();

        DB::transaction(function () use ($post, $request) {

            $order = Order::create($post);

            $add_orders = new AddOrders($post, $order);

            $add_orders->create();

            Mail::to($post['email'])->send(new OrderAccepted($order->id));

        });

//        return response()->json($request->all());
    }
}
