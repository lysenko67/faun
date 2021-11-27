<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\UI\API\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ProductResource extends JsonResource
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
            'title' => $this->title,
            'author' => $this->author,
            'category' => $this->category->title,
            'category_slug' => $this->category->slug,
            'description' => $this->description,
            'price' => $this->$this->price,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'created_at' => Carbon::parse($this->created_at)->format('Y. m. d'),
            'images' => ImagesResource::collection($this->images),
        ];
    }
}
