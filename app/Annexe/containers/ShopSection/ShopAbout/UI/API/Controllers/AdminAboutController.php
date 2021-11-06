<?php

namespace App\Annexe\containers\ShopSection\ShopAbout\UI\API\Controllers;

use App\Annexe\containers\ShopSection\ShopAbout\Repositories\AboutRepository;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;
use Illuminate\Http\Request;

class AdminAboutController extends ControllerCore
{
    public $aboutRepository;

    public function __construct(AboutRepository $aboutRepository)
    {
        $this->aboutRepository = $aboutRepository;
    }

    public function index(Request $request)
    {
        $request = $request->all();

        $contacts = $this->aboutRepository->getAbout();

        if (!empty($request)) {
            $contacts->update([
                'content' => $request['content']
            ]);
        }

        return response()->json($contacts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        return response()->json($request->all());
        $data = $this->aboutRepository->updateAbout($request->all(), $id);

        return response()->json($data);
    }
}
