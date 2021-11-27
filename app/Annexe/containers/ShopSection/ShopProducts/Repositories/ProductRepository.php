<?php


namespace App\Annexe\containers\ShopSection\ShopProducts\Repositories;

use App\Annexe\containers\ShopSection\ShopProducts\Models\Product as Model;
use App\Annexe\containers\ShopSection\ShopProducts\Models\ProductImage;
use App\Annexe\containers\ShopSection\ShopProducts\Models\ProductGltf;
use App\Annexe\Ship\Core\Abstracts\Repositories\CoreRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Collection;

class ProductRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Model::class;
    }


    /**
     * @var
     */
    protected $category;

    /**
     * @var string[]
     */
    protected $columns = [
        'id',
        'title',
        'author',
        'description',
        'price',
        'slug',
        'category_id',
        'created_at'
    ];

    /**
     * @return mixed
     */
    public function getAllProducts($count = 10000)
    {
        $products = $this
            ->startConditions()
            ->select($this->columns)
            ->orderBy('id', 'DESC')
            ->with([
                'category:id,title,slug',
                'images:id,product_id,img,id',
                'gltfFile:id,product_id,gltf,id'
            ])
            ->latest()
            ->paginate($count = 10000);
        return $products;
    }

    /**
     * @param $category_id
     * @param $count
     * @return mixed
     */
    public function getAllProductsOnlyCategory($category_id, $count)
    {
        $products = $this
            ->startConditions()
            ->select($this->columns)
            ->orderBy('id', 'DESC')
            ->where('category_id', $category_id)
            ->with([
                'category:id,title,slug',
                'images:product_id,img',
                'gltfFile:product_id,gltf'
            ])
            ->latest()
            ->paginate($count);

        return $products;
    }

    /**
     * @param $id
     * @return array product
     */
    public function getCartProduct($id)
    {
        $product = $this
            ->startConditions()
            ->select([
                'id',
                'title',
                'price',
                'slug',
                'category_id',
            ])
            ->with([
                'category:id,title,slug',
                'images:product_id,img,id',
                'gltfFile:product_id,gltf,id'
            ])
            ->find($id)->toArray();

        $product['images'] = array_shift($product['images'])['img'];
        $product['gltfFile'] = array_shift($product['gltfFile'])['gltf'];

        return $product;
    }

    /**
     * @param $slug
     * @return Collection $product
     */
    public function getOneProduct($slug)
    {
        $product = $this
            ->startConditions()
            ->select($this->columns)
            ->where('slug', $slug)
            ->with([
                'category:id,title',
                'images:product_id,img,id',
                'gltfFile:product_id,gltf,id'
            ])
            ->first();

        return $product;
    }

    // Создание продукта

    /**
     * @param $request
     * @return mixed
     */
    public function createProduct($request)
    {
        return $this
            ->startConditions()
            ->create($request);
    }

    public function deleteProduct($id)
    {
        $product = $this->startConditions()->find($id);
        Storage::deleteDirectory('public/images/' . $id);
        $product->delete();
    }

    // Обновление продукта

    /**
     * @param $data
     * @param $id
     */
    public function updateProduct($data, $id)
    {
        $this
            ->startConditions()
            ->find($id)
            ->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getImages($id)
    {
        $images = ProductImage::where('product_id', $id)->get();

        return $images;
    }

    /**
     * @param $image
     */
    public function createImage($image)
    {
        ProductImage::create($image);
    }

    /**
     * @param $gltf
     */
    public function createGltf($gltf)
    {
        ProductGltf::create($gltf);
    }

    /**
     * @param $id
     * @param $image
     */
    public function deleteImage($product_id, $img_name, $image_id)
    {
        DB::transaction(function () use ($product_id, $img_name, $image_id) {
            Storage::delete('public/images/' . $product_id . '/' . $img_name);
            ProductImage::find($image_id)->forceDelete();
        });
    }

    /**
     * @param $id
     * @param $image
     */
    public function updateGltf($product_id, $fileGltf)
    {
        DB::transaction(function () use ($product_id, $fileGltf) {

            Storage::deleteDirectory('public/images/' . $product_id . '/model_3d');

            $fileGltf->storeAs('public/images/' . $product_id . '/model_3d', $fileGltf->getClientOriginalName());
            $gltf = [
                'gltf' => $fileGltf->getClientOriginalName(),
                'product_id' => $product_id
            ];
            ProductGltf::where('product_id', $product_id)->update($gltf);
        });
    }
}
