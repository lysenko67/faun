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
        'created_at'
    ];

    public function getAllOrders()
    {
        $orders = $this
            ->startConditions()
            ->select($this->columns)
            ->with([
                'products:id,order_id,title,vendor_code,qty,sum',
            ])
            ->latest()
            ->paginate(10);

        return $orders;
    }
}
