<?php


namespace App\Annexe\containers\ShopSection\ShopContacts\Repositories;


use App\Annexe\containers\ShopSection\ShopContacts\Models\Contact as Model;
use App\Annexe\Ship\Core\Abstracts\Repositories\CoreRepository;


class ContactRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Model::class;
    }

    private $columns = [
        'id',
        'phone',
        'email',
        'working_hours',
        'text'
    ];

    public function getContacts()
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
    public function updateContacts($data, $id)
    {
        $contacts = $this
            ->startConditions()
            ->find($id)
            ->update($data);

        return $contacts;
    }
}
