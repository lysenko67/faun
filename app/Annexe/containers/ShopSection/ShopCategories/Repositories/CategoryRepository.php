<?php


namespace App\Annexe\containers\ShopSection\ShopCategories\Repositories;


use App\Annexe\containers\ShopSection\ShopCategories\Models\Category as Model;
use App\Annexe\Ship\Core\Abstracts\Repositories\CoreRepository;

class CategoryRepository extends CoreRepository
{
    private $columns = [
        'id',
        'title',
        'slug'
    ];

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @return mixed
     */
    public function getAllCategories()
    {
        $result = $this
            ->startConditions()
            ->select($this->columns)
            ->toBase()
            ->get();
        return $result;
    }

    public function getCategory($slug)
    {
        $category = $this
            ->startConditions()
            ->select($this->columns)
            ->where('slug', $slug)
            ->first()
            ->toArray();

        return $category;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getOneCategory($id)
    {
        $result = $this
            ->startConditions()
            ->select($this->columns)
            ->toBase()
            ->find($id);

        return $result;
    }

    public function addNewCategory($request) {
        return $this
            ->startConditions()
            ->create($request);
    }

    public function updateCategory($data, $id) {
        $this
            ->startConditions()
            ->find($id)
            ->update($data);
    }

    public function deleteCategory($id) {
        $this->startConditions()->find($id)->forceDelete();
    }
}
