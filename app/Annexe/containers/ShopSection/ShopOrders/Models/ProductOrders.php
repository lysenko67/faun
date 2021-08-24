<?php

namespace App\Annexe\containers\ShopSection\ShopOrders\Models;
use Illuminate\Database\Eloquent\Model;

class ProductOrders extends Model
{

    protected $fillable = [
        'order_id',
        'vendor_code',
        'title',
        'sum',
        'qty'
    ];

    public function product() {
        return $this->belongsTo(Order::class);
    }

}
