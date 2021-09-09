<?php

namespace App\Annexe\containers\ShopSection\ShopContacts\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $fillable = [
        'phone',
        'email',
        'working_hours',
        'text'
    ];
}
