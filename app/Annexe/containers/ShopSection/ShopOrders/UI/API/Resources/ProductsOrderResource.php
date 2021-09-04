<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\UI\API\Resources;

use App\Annexe\containers\ShopSection\ShopProducts\Models\ProductImage;
use App\Annexe\containers\ShopSection\ShopProducts\UI\API\Resources\ImagesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsOrderResource extends JsonResource
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
            'vendor_code' => $this->vendor_code,
            'qty' => $this->qty,
            'sum' => $this->sum,
            'image' => $this->getPath().$this->vendor_code.'/'.$this->getImage()
        ];
    }

    public function getImage()
    {
        $image = new ProductImage();
        return $image
            ->select('img')
            ->where('product_id', $this->vendor_code)
            ->get()[0]
            ->img;
    }

    public function getPath()
    {
        return url('/').'/storage/images/';
    }
}
