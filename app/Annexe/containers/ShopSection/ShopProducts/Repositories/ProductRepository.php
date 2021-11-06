<?php


namespace App\Annexe\containers\ShopSection\ShopProducts\Repositories;

use App\Annexe\containers\ShopSection\ShopProducts\Models\Product as Model;
use App\Annexe\containers\ShopSection\ShopProducts\Models\ProductImage;
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
    public function getAllProducts($count=10000)
    {
        $products = $this
            ->startConditions()
            ->select($this->columns)
            ->orderBy('id', 'DESC')
            ->with([
                'category:id,title,slug',
                'images:id,product_id,img,id'
            ])
            ->latest()
            ->paginate($count=10000);
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
                'images:product_id,img'
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
                'images:product_id,img,id'
            ])
            ->find($id)->toArray();

        $product['images'] = array_shift($product['images'])['img'];

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
                'images:product_id,img,id'
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
     * @param $id
     * @param $image
     */
    public function deleteImage($id, $image, $idImage)
    {
        $res = DB::transaction(function() use($id, $image, $idImage) {
            Storage::delete('public/images/' . $id . '/' . $image);
            ProductImage::find($idImage)->forceDelete();
        });
        return $res;
    }
}
