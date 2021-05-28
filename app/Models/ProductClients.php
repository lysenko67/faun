<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductClients extends Model
{

    protected $fillable = [
        'client_id',
        'vendor_code',
        'title',
        'sum',
        'qty'
    ];

    public function product() {
        return $this->belongsTo(Client::class);
    }

}
