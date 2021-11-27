<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\UI\API\Controllers;

use App\Annexe\containers\ShopSection\ShopProducts\Repositories\ProductRepository;
use App\Annexe\containers\ShopSection\ShopProducts\Services\ProductService;
use App\Annexe\containers\ShopSection\ShopProducts\UI\API\Requests\ProductRequest;
use App\Annexe\containers\ShopSection\ShopProducts\UI\API\Resources\ProductResource;
use App\Annexe\Ship\Core\Abstracts\Controllers\ApiControllerCore;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AdminProductController extends ApiControllerCore
{
    /**
     * @var ProductRepository
     */
    public $productRepository;
    public $productService;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository, ProductService $productService)
    {
        $this->productService = $productService;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $request = $request->only('count', 'category');

        if (!empty($request['category']) && $request['category'] != 'all') {

            $products = $this->productRepository->getAllProductsOnlyCategory($request['category'], $request['count']);
        } else {

            $products = $this->productRepository->getAllProducts($request['count']);
        }

        return response()->json([
            'products' => ProductResource::collection($products),
            'paginate' => [
                'total' => $products->total(),
                'currentPage' => $products->currentPage()
            ]

        ], JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->productService->addNewProduct($request->all());
    }

    /**
     * Get one cost category record by id
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $product = $this->productRepository->getOneProduct($id);

        return response()->json(new ProductResource($product), JsonResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $this->productService->updateProduct($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepository->deleteProduct($id);
    }
}
