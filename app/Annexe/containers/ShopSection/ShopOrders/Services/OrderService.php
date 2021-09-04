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

    /**
     * @param $count
     * @return mixed
     */
    public function getAllOrders($count)
    {
        return $this->orderRepository->getAllOrders($count);
    }

    /**
     * @param $id
     * @param $post
     */
    public function updateOrder($id, $post)
    {
        $order = $this->orderRepository->getOneOrder($id);
        $order->status = $post;
        $order->save();
    }

}
