<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'name',
        'email',
        'phone',
        'text'
    ];

    public function products() {
        return $this->hasMany(ProductOrders::class);
    }

    public static function getStatus($status) {
        if($status === 'accepted') $background = '#fff0f4';
        if($status === 'mail') $background = '#fff0d4';
        if($status === 'delivery') $background = '#e0eeff';
        if($status === 'arrived') $background = '#f1f1f1';
        if($status === 'completed') $background = '#e2ffe2';
        return $background;
    }

    public static function statusTranslates($status) {
        if($status === 'accepted') $translate = 'Принят';
        if($status === 'mail') $translate = 'Ожидает отправки';
        if($status === 'delivery') $translate = 'В пути';
        if($status === 'arrived') $translate = 'Прибыл';
        if($status === 'completed') $translate = 'Завершён';
        return $translate;
    }

}
