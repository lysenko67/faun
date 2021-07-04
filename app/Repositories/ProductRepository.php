<?php


namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use phpDocumentor\Reflection\Types\Collection;

class ProductRepository
{
    protected $category;
    protected $columns = [
        'id',
        'title',
        'description',
        'price',
        'slug',
        'category_id',
    ];

    public function getProducts()
    {
        $products = $this->product()
            ->select($this->columns)
            ->orderBy('id', 'DESC')
            ->with([
                'category:id,title,slug',
                'images:product_id,img'
            ])
            ->paginate(10);

        return $products;
    }

    /**
     * @param $id
     * @return array product
     */
    public function getProduct($id)
    {
        $product = $this->product()
            ->select($this->columns)
            ->with([
                'category:id,title,slug',
                'images:product_id,img'
            ])
            ->find($id)->toArray();

        return $product;
    }

    /**
     * @param $slug
     * @return Collection $product
     */
    public function getOneProduct($slug)
    {
        $product = $this->product()
            ->select($this->columns)
            ->where('slug', $slug)
            ->with([
                'category:id,title',
                'images:product_id,img'
            ])
            ->first();

        return $product;
    }

    public function getProductOneCategory()
    {
        $products = $this->product()
            ->select($this->columns)
            ->orderBy('id', 'DESC')
            ->where('category_id', $this->category->id)
            ->with([
                'category:id,title,slug',
                'images:product_id,img'
            ])
            ->paginate(10);

//        dd(__METHOD__, $products);
        return $products;
    }

    public function getCategory($slug)
    {
        $category = $this->category()
            ->where('slug', $slug)
            ->first();

        $this->category = $category;

        return $category->title;
    }

    /**
     * @return Product
     */
    public function product()
    {
        $model = new Product();
        return clone $model;
    }

    /**
     * @return Category
     */
    public function category()
    {
        $model = new Category();
        return clone $model;
    }

}
