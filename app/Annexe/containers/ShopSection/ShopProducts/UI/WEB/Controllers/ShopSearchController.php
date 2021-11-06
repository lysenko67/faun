<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\UI\WEB\Controllers;

use App\Annexe\containers\ShopSection\ShopOrders\Repositories\ProductOrderRepository;
use App\Annexe\containers\ShopSection\ShopProducts\Models\Product;
use App\Annexe\containers\ShopSection\ShopProducts\UI\API\Resources\ProductResource;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;
use Illuminate\Http\Request;

class ShopSearchController extends ControllerCore
{
    public $productRepository;

    public function __construct(ProductOrderRepository $orderRepository)
    {
        $this->productRepository = $orderRepository;
    }

    public function index(Request $request)
    {
        $data = $request->json()->all();

        $text = Product::where($data['checked'], 'LIKE', "%{$data['text']}%")->orderBy('title')->paginate(5);

        return response()->json(ProductResource::collection($text));
    }
}
