<?php

namespace App\Annexe\containers\ShopSection\ShopProducts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductGltf extends Model
{
    protected $fillable = [
        'gltf',
        'product_id'
    ];
}
