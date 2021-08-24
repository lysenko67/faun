<?php


namespace App\Annexe\Ship\Core\Abstracts\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class ControllerCore extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
