<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\Repositories;

use App\Annexe\containers\ShopSection\ShopOrders\Models\ProductOrders as Model;
use App\Annexe\Ship\Core\Abstracts\Repositories\CoreRepository;

class ProductOrderRepository extends CoreRepository
{
    public function getModelClass(): string
    {
        return Model::class;
    }

    public function updateProductOrder($product, $id)
    {
        return $this
            ->startConditions()
            ->find($id)
            ->update($product);
    }
}
