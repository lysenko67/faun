<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\Services;

use App\Annexe\containers\ShopSection\ShopProducts\Repositories\ProductRepository;
use Mockery\Undefined;

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

    public function getProducts()
    {
        $products = $this->productRepository->getAllProducts();
        return $products;
    }

    public function getProduct($slug)
    {
        $product = $this->productRepository->getOneProduct($slug);
        $product->price = $this->getPrice($product->price);

        return $product;
    }

    private function getPrice($price)
    {
        foreach (explode(';', $price) as $item) {
            $arr = explode('=', $item);
            $array[$arr[0]] = $arr[1];
        }

        return $array;
    }

    /**
     * @param $request
     */
    public function addNewProduct($request)
    {
        $product = $this->productRepository->createProduct($request);
        if (isset($request['files'])) {
            $files = $request['files'];
            $this->addNewImages($files, $product->id);
        }

        if (isset($request['fileGltf'])) {
            $fileGltf = $request['fileGltf'];
            $this->addNewGltf($fileGltf, $product->id);
        }
    }

    /**
     * @param $files
     * @param $id
     */
    private function addNewImages($files, $product_id)
    {
        foreach ($files as $file) {
            $path = $file->store('public/images/' . $product_id);
            $img = explode('/', $path)[3];
            $image = [
                'img' => $img,
                'product_id' => $product_id
            ];
            $this->productRepository->createImage($image);
        }
    }

    private function addNewGltf($fileGltf, $product_id)
    {
        $path = $fileGltf->storeAs('public/images/' . $product_id . '/model_3d', $fileGltf->getClientOriginalName());
        $gl = explode('/', $path)[4];
        $gltf = [
            'gltf' => $gl,
            'product_id' => $product_id
        ];
        $this->productRepository->createGltf($gltf);
    }

    public function updateProduct($request, $product_id)
    {

        $data = $request->all();

        if (isset($data['img_name'])) {

            $images = $this->productRepository->getImages($product_id);

            foreach ($images as $item) {
                if ($data['img_name'] === $item['img']) {
                    $this->productRepository->deleteImage($data['product_id'], $data['img_name'], $data['image_id']);
                }
            }
        } else {
            if (isset($data['files'])) {
                $files = $request['files'];
                $this->addNewImages($files, $product_id);
            }
            if ($data['fileGltf'] != 'undefined') {
                $this->productRepository->updateGltf($product_id, $data['fileGltf']);
            }
            $this->productRepository->updateProduct($data, $product_id);
        }
    }
}
