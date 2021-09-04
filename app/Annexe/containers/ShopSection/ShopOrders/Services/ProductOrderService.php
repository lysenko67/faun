<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\Services;

use App\Annexe\containers\ShopSection\ShopOrders\Repositories\OrderRepository;
use App\Annexe\containers\ShopSection\ShopOrders\Repositories\ProductOrderRepository;
use Illuminate\Support\Facades\DB;

class ProductOrderService
{
    /**
     * @var OrderRepository
     */
    public $orderRepository;
    public $productOrderRepository;

    /**
     * @param OrderRepository $productRepository
     */
    public function __construct(OrderRepository $orderRepository, ProductOrderRepository $productOrderRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productOrderRepository = $productOrderRepository;
    }

    public function updateProductsOrder($order, $id)
    {
//        DB::transaction(function () use ($order, $id) {

            $this->orderRepository->updateOrder($order, $id);

            foreach ($order['products'] as $product) {
                $this->productOrderRepository->updateProductOrder($product, $product['id']);
            }

//        });
    }
}
