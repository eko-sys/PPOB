<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Auth;

class EmailController extends Controller
{
    public function email(Request $request)
    {

        Mail::to('padamara555@gmail.com')->send(new EmailVerification($name));
    }

    public function test()
    {
    	return view('email.userVerify');
    }
}
