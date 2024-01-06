<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactSendmail;
use Exception;
use Illuminate\Support\Facades\Log;


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
        try {
            $contact = $request->all();
            \Mail::to('banbutsuRanking@gmail.com')->send(new ContactSendmail($contact));
            $request->session()->regenerateToken();
            return view('contact.thanks');
        } catch (Exception $e) {
            Log::error("送信失敗しました。", ['exception' => $e]);
            echo "送信失敗しました。";
        }
    }
}
