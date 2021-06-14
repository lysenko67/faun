<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\OrderAccepted;
use App\Models\Order;
use App\Models\ProductOrders;
use App\Services\AddOrders\AddOrders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $get = $request->all();
        if (!empty($get['sort-status']) && $get['sort-status'] != 'all') {
            $get = $get['sort-status'];
            $orders = Order::where('status', $get)
                ->latest()
                ->paginate(10);

            return view('admin.orders.index', compact('orders', 'get'));
        }

        $orders = Order::with('products')
            ->latest()
            ->paginate(10);
        return view('admin.orders.index', compact('orders'));
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::with('products')->find($id);

        return view('admin.orders.edit', compact('order'));
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
            return redirect()->route('orders.index')->with('success', 'Изменения приняты');
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

        return redirect()->route('orders.index')->with('success', 'Заказ удален');
    }
}
