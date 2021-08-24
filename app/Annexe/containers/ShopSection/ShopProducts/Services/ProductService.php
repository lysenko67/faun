<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\Services;

use App\Annexe\containers\ShopSection\ShopProducts\Repositories\ProductRepository;

class ProductService
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
     * @param $request
     */
    public function addNewProduct($request) {
        $product = $this->productRepository->createProduct($request);
        if (isset($request['files'])) {
            $files = $request['files'];
            $this->addNewImages($files, $product->id);
        }
    }

    /**
     * @param $files
     * @param $id
     */
    private function addNewImages($files, $id)
    {
        foreach ($files as $file) {
            $path = $file->store('public/images/' . $id);
            $img = explode('/', $path)[3];
            $image = [
                'img' => $img,
                'product_id' => $id
            ];
            $this->productRepository->createImage($image);
        }
    }

    public function updateProduct($request, $id) {

        $data = $request->all();

        if(isset($data['img_name'])) {

            $images = $this->productRepository->getImages($id);

            foreach ($images as $item) {
                if($data['img_name'] === $item['img']) {
                    $this->productRepository->deleteImage($id, $item->img);
                }
            }

        } else {
            if(isset($data['files'])) {
                $files = $request['files'];
                $this->addNewImages($files, $id);
            }
            $this->productRepository->updateProduct($data, $id);
        }
    }
}
