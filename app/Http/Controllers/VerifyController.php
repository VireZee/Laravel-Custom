<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyController extends Controller
{
    function index()
    {
        return view('verification.verify');
    }
    function verify(EmailVerificationRequest $r)
    {
        $r->fulfill();
        return redirect('index');
    }
    function reverify(Request $r)
    {
        $r->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
    function verified()
    {
        return view('verification.verified');
    }
}
