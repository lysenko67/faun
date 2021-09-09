<?php

namespace App\Annexe\containers\ShopSection\ShopContacts\UI\API\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'phone' => $this->phone,
            'email' => $this->email,
            'working_hours' => $this->working_hours,
            'text' => $this->text
        ];
    }

}
