<?php

namespace App\Annexe\containers\ShopSection\ShopAbout\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $casts = [
        'content' => 'array'
    ] ;

    public $fillable = [
        'content'
    ];
}
