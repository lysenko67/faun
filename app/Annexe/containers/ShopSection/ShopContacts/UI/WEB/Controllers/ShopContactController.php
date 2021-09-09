<?php

namespace App\Annexe\containers\ShopSection\ShopContacts\UI\WEB\Controllers;

use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;

class ShopContactController extends ControllerCore
{

    public function index()
    {
        return view('shop.contacts.index');
    }

}
