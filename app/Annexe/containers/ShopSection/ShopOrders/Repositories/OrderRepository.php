<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\Repositories;

use App\Annexe\containers\ShopSection\ShopOrders\Models\Order as Model;
use App\Annexe\Ship\Core\Abstracts\Repositories\CoreRepository;

class OrderRepository extends CoreRepository
{
    public function getModelClass(): string
    {
        return Model::class;
    }

    protected $columns = [
        'id',
        'name',
        'email',
        'text',
        'phone',
        'country',
        'address',
        'index',
        'status',
        'created_at'
    ];

    public function getAllOrders($count)
    {
        $orders = $this
            ->startConditions()
            ->select($this->columns)
            ->with([
                'products:id,order_id,title,vendor_code,qty,sum',
            ])
            ->latest()
            ->paginate($count);

        return $orders;
    }

    public function getAllOrdersOnlyStatus($status, $count)
    {
        $orders = $this
            ->startConditions()
            ->select($this->columns)
            ->with([
                'products:id,order_id,title,vendor_code,qty,sum',
            ])
            ->where('status', $status)
            ->latest()
            ->paginate($count);

        return $orders;
    }

    public function getOneOrder($id)
    {
        $order = $this
            ->startConditions()
            ->select($this->columns)
            ->where('id', $id)
            ->with([
                'products:id,order_id,title,vendor_code,qty,sum',
            ])
            ->first();

        return $order;
    }

    public function updateOrder($data, $id)
    {
        return $this
            ->startConditions()
            ->find($id)
            ->update($data);
    }

    public function deleteOrder($id)
    {
        $this
            ->startConditions()
            ->find($id)
            ->delete();
    }
}
