<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\Repositories;

use App\Annexe\containers\ShopSection\ShopOrders\Models\Order as Model;
use App\Annexe\Ship\Core\Abstracts\Repositories\CoreRepository;

class OrderRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @var string[]
     */
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

    /**
     * @param $count
     * @return mixed
     */
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

    /**
     * @param $status
     * @param $count
     * @return mixed
     */
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

    /**
     * @param $id
     * @return mixed
     */
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

    public function createOrder($data)
    {
        return $this
            ->startConditions()
            ->create($data);
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function updateOrder($data, $id)
    {
        return $this
            ->startConditions()
            ->find($id)
            ->update($data);
    }

    /**
     * @param $id
     */
    public function deleteOrder($id)
    {
        $this
            ->startConditions()
            ->find($id)
            ->delete();
    }
}
