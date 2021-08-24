<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\UI\API\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->getPath() . $this->product_id  . '/' .  $this->product_images . $this->img,
        ];
    }

    public function getPath()
    {
        return url('/').'/storage/images/';
    }
}
