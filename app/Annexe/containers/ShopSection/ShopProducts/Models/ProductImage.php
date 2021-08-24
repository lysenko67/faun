<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $fillable = [
        'img',
        'product_id'
    ];

}
