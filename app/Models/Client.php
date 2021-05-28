<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = [
        'name',
        'email',
        'phone',
        'text'
    ];

    public function product() {
        return $this->hasMany(ProductClients::class);
    }

}
