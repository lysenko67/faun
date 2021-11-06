<?php

namespace App\Annexe\containers\ShopSection\ShopAbout\Repositories;

use App\Annexe\containers\ShopSection\ShopAbout\Models\About as Model;
use App\Annexe\Ship\Core\Abstracts\Repositories\CoreRepository;


class AboutRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Model::class;
    }

    private $columns = [
        'contents'
    ];

    public function getAbout()
    {
        $contacts = $this
            ->startConditions()
            ->select($this->columns)
            ->first();

        return $contacts;
    }

    /**
     * @param $data
     * @param $id
     */
    public function updateAbout($data, $id)
    {
        $contacts = $this
            ->startConditions()
            ->find($id)
            ->update($data);

        return $contacts;
    }
}

