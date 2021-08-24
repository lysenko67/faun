<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\UI\API\Controllers;

use App\Annexe\containers\ShopSection\ShopOrders\Models\Order;
use App\Annexe\containers\ShopSection\ShopOrders\Repositories\OrderRepository;
use App\Annexe\Ship\Core\Abstracts\Controllers\ApiControllerCore;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\OrderAccepted;

use App\Services\AddOrders\AddOrders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends ApiControllerCore
{

    protected $orderServices;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderServices = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $get = $request->all();
//        if (!empty($get['sort-status']) && $get['sort-status'] != 'all') {
//            $get = $get['sort-status'];
//            $orders = Order::where('status', $get)
//                ->latest()
//                ->paginate(10);
//
//            return response()->json($orders);
//        }

        $orders = $this->orderServices->getAllOrders();

        return response()->json($orders);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $post = $request->all();

        $transaction = DB::transaction(function () use ($post, $id) {

            $order = Order::find($id);

            if (isset($post['status'])) {
                $order->status = $post['status'];
                $order->save();
                return true;
            }

            $add_orders = new AddOrders($post, $order);

            $add_orders->update();
            return true;
        });


        if ($transaction) {
            return response()->json('');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        $order->delete();
    }
}

