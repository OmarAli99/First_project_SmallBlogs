<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request ->validate(
            [
                'name' => 'required|string',
                'email' => 'required|email',
                'subject' => 'required',
                'message' =>'required',
            ]
            );

        Contacts::create($data);
        return back()->with('status-message' , 'message sent successfully');

    }
}
