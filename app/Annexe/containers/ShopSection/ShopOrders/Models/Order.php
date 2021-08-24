<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'text'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(ProductOrders::class);
    }

    /**
     * @param $status
     * @return string
     */
    public static function getStatus($status) {
        if($status === 'accepted') $background = '#fff0f4';
        if($status === 'mail') $background = '#fff0d4';
        if($status === 'delivery') $background = '#e0eeff';
        if($status === 'arrived') $background = '#f1f1f1';
        if($status === 'completed') $background = '#e2ffe2';
        return $background;
    }

    /**
     * @param $status
     * @return string
     */
    public static function statusTranslates($status) {
        if($status === 'accepted') $translate = 'Принят';
        if($status === 'mail') $translate = 'Ожидает отправки';
        if($status === 'delivery') $translate = 'В пути';
        if($status === 'arrived') $translate = 'Прибыл';
        if($status === 'completed') $translate = 'Завершён';
        return $translate;
    }

}
