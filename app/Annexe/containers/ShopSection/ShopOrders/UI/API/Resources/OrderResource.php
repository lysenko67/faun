<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\UI\API\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class OrderResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'text' => $this->text,
            'country' => $this->country,
            'address' => $this->address,
            'index' => $this->index,
            'status' => [
                'name' => $this->status,
                'background' => $this->getStatusBackground($this->status),
                'translate' => $this->statusTranslates($this->status),
                'img' => 'http://faun.loc/public/images/mail/'.$this->status.'.svg'
            ],
            'created_at' => Carbon::parse($this->created_at)->format('Y. m. d'),
            'products' => ProductsOrderResource::collection($this->products)
        ];
    }

    public function getStatusBackground($status)
    {
        if($status === 'accepted') $background = '#fff0f4';
        if($status === 'mail') $background = '#fff0d4';
        if($status === 'delivery') $background = '#e0eeff';
        if($status === 'arrived') $background = '#f1f1f1';
        if($status === 'completed') $background = '#e2ffe2';
        return $background;
    }

    public function statusTranslates($status)
    {
        if($status === 'accepted') $translate = 'Принят';
        if($status === 'mail') $translate = 'Ожидает отправки';
        if($status === 'delivery') $translate = 'В пути';
        if($status === 'arrived') $translate = 'Прибыл';
        if($status === 'completed') $translate = 'Завершён';
        return $translate;
    }

}


