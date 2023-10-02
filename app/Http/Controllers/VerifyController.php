<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerifyController extends Controller
{
    function index()
    {
        return view('auth.verify');
    }
    function reverify(Request $r)
    {
        $user = User::where('email', $r->email)
            ->orWhere('verify_token', $r->verify_token)
            ->first();
        if ($user) {
            Mail::send('auth.notice', ['verify_token' => $r->verify_token], function ($message) use ($r) {
                $message->to($r->email);
                $message->subject('Email Verification');
            });
            return redirect()->route('verify.index')->with('verify_token', $r->verify_token);
        } else {
            return redirect()->route('verify.index')->with('error', 'User not found.');
        }
    }
    function verify($verify_token)
    {
        $user = User::where('verify_token', $verify_token)->first();
        if ($user) {
            $user->verified = now()->format('d F Y, h:i:s.u A');
            $user->verify_token = null;
            $user->save();
            return redirect()->route('verified');
        } else if ($verify_token !== $user->verify_token) {
            return view('auth.invalid');
        } else if ($user->verify_token !== null) {
            return view('auth.already.verified');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }
    function verified()
    {
        return view('auth.verified');
    }
}