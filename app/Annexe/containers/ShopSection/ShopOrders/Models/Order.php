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
        'country',
        'address',
        'index',
        'text',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(ProductOrders::class);
    }

}
