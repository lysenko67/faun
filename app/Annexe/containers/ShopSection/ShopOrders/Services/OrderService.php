<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\Services;

use App\Annexe\containers\ShopSection\ShopOrders\Repositories\OrderRepository;

class OrderService
{
    /**
     * @var OrderRepository
     */
    public $orderRepository;

    /**
     * @param OrderRepository $productRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }

}
