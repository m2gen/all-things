<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactSendmail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.form');
    }

    public function confirm(ContactFormRequest $request)
    {
        $contact = $request->all();
        return view('contact.confirm', compact('contact'));
    }

    public function send(ContactFormRequest $request)
    {
        $contact = $request->all();
        \Mail::to('ymslash78@gmail.com')->send(new ContactSendmail($contact));
        $request->session()->regenerateToken();
        return view('contact.thanks');
    }
}
