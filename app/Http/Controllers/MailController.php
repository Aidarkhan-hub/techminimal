<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        return view('mail_form');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'message' => 'required|string|max:500',
        ]);


        return back()->with('success', 'Email успешно отправлен на ' . $request->email);
    }
}
