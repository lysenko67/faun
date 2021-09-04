<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\UI\API\Controllers;

use App\Annexe\containers\ShopSection\ShopOrders\Models\Order;
use App\Annexe\containers\ShopSection\ShopOrders\Models\ProductOrders;
use App\Annexe\containers\ShopSection\ShopOrders\Repositories\OrderRepository;
use App\Annexe\containers\ShopSection\ShopOrders\Services\OrderService;
use App\Annexe\containers\ShopSection\ShopOrders\UI\API\Resources\OrderResource;
use App\Annexe\containers\ShopSection\ShopOrders\UI\API\Resources\ProductsOrderResource;
use App\Annexe\Ship\Core\Abstracts\Controllers\ApiControllerCore;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminProductOrderController extends ApiControllerCore
{

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ProductOrders::find($id);
        $product->delete();

        return response()->json('success');
    }
}


