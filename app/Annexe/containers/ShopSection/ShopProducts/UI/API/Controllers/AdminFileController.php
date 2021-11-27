<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\UI\API\Controllers;

use App\Annexe\containers\ShopSection\ShopProducts\Repositories\ProductRepository;
use App\Annexe\Ship\Core\Abstracts\Controllers\ApiControllerCore;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AdminFileController extends ApiControllerCore
{
    /**
     * @var ProductRepository
     */
    public $productRepository;
    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $image_id)
    {
        $data = $request->all();
        $this->productRepository->deleteImage($data['product_id'], $data['img_name'], $image_id);
        return response()->json(['success' => 'Фото удалено']);
    }
}
