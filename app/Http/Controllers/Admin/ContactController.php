<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contact = Contact::all();

        if (!empty($request->all())) {

            $request = $request->all();
;
            $contact = Contact::where('id', $contact[0]->id)->update([
                'phone' => $request['phone'],
                'email' => $request['email'],
                'working_hours' => $request['working_hours'],
                'text' => $request['text']
            ]);

            $contact = Contact::all();

        }

        return view('admin.contacts.index', ['contact' => $contact[0]]);
    }
}


