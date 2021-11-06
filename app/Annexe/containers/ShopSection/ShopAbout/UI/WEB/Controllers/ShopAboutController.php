<?php

namespace App\Annexe\containers\ShopSection\ShopAbout\UI\WEB\Controllers;

use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;

class ShopAboutController extends ControllerCore
{
    public function index()
    {
        return view('shop.about.index');
    }
}
