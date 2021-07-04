<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ShopContactController extends Controller
{

    public function index()
    {
        return view('shop.contacts.index');
    }

}
