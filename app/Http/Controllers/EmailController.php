<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public function index(){
        return view('mail.index');
    }

    public function send(EmailRequest $request)
{
    Mail::to($request->email)->send(
        new TestMail($request->email, $request->subject, $request->bodyMessage)
    );

    return redirect()->back()->with('success', 'Email sent successfully!');
}

}
