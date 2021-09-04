<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\UI\API\Controllers;

use App\Annexe\containers\ShopSection\ShopOrders\Models\Order;
use App\Annexe\containers\ShopSection\ShopOrders\Repositories\OrderRepository;
use App\Annexe\containers\ShopSection\ShopOrders\Services\OrderService;
use App\Annexe\containers\ShopSection\ShopOrders\Services\ProductOrderService;
use App\Annexe\containers\ShopSection\ShopOrders\UI\API\Resources\OrderResource;
use App\Annexe\Ship\Core\Abstracts\Controllers\ApiControllerCore;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminOrderController extends ApiControllerCore
{

    protected $orderRepository;
    protected $orderServices;
    private $productOrderService;

    public function __construct(OrderRepository $orderRepository, OrderService $orderService, ProductOrderService $productOrderService)
    {
        $this->orderRepository = $orderRepository;
        $this->orderServices = $orderService;
        $this->productOrderService = $productOrderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request = $request->only('count', 'status');

        if (!empty($request['status']) && $request['status'] != 'all') {

            $orders = $this->orderRepository->getAllOrdersOnlyStatus($request['status'], $request['count']);

        } else {

            $orders = $this->orderServices->getAllOrders($request['count']);

        }

        return response()->json([
            'orders' => OrderResource::collection($orders),
            'paginate' => [
                'total' => $orders->total(),
                'currentPage' => $orders->currentPage()
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->getOneOrder($id);

        return response()->json(new OrderResource($order), JsonResponse::HTTP_OK);
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
//        $data = $request->all();
//        return response()->json($data['products']);

        if($request->get('count')) {
            $post = $request->get('status');

            $this->orderServices->updateOrder($id, $post);

            $orders = $this->orderServices->getAllOrders($request['count']);

            return response()->json([
                'orders' => OrderResource::collection($orders),
                'paginate' => [
                    'total' => $orders->total(),
                    'currentPage' => $orders->currentPage()
                ]
            ]);
        } else {
            $this->productOrderService->updateProductsOrder($request->all(), $id);
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
        $this->orderRepository->deleteOrder($id);
    }
}

