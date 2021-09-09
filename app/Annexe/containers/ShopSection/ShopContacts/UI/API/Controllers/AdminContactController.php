<?php

namespace App\Annexe\containers\ShopSection\ShopContacts\UI\API\Controllers;

use App\Annexe\containers\ShopSection\ShopContacts\Repositories\ContactRepository;
use App\Annexe\containers\ShopSection\ShopContacts\UI\API\Resources\ContactResource;
use App\Annexe\Ship\Core\Abstracts\Controllers\ControllerCore;
use Illuminate\Http\Request;

class AdminContactController extends ControllerCore
{
    public $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index(Request $request)
    {
        $request = $request->all();

        $contacts = $this->contactRepository->getContacts();

        if (!empty($request)) {
            $contacts->update([
                'phone' => $request['phone'],
                'email' => $request['email'],
                'working_hours' => $request['working_hours'],
                'text' => $request['text']
            ]);
        }

        return response()->json(new ContactResource($contacts));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        return response()->json($request->all());
        $data = $this->contactRepository->updateContacts($request->all(), $id);

        return response()->json($data);
    }
}


