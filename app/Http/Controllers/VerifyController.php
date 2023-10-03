<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerifyController extends Controller
{
    function index(Request $r)
    {
        $r->session()->get('verify_token');
        return view('auth.verify', ['verify_token' => $r->verify_token]);
    }
    function reverify(Request $r)
    {
        User::where('verify_token', $r->verify_token)->first();
        Mail::send('auth.notice', ['verify_token' => $r->verify_token], function ($message) use ($r) {
            $message->to($r->email);
            $message->subject('Email Verification');
        });
        return redirect()->route('verify.index', ['verify_token' => $r->verify_token]);
    }
    function verify($verify_token)
    {
        $user = User::where('verify_token', $verify_token)->first();
        if ($user) {
            $user->is_verified = true;
            $user->verified = now()->format('d F Y, h:i:s.u A');
            $user->verify_token = null;
            $user->save();
            return redirect()->route('verified');
        } else if ($verify_token !== $user->verify_token) {
            return view('auth.invalid');
        } else if ($user->is_verified == true) {
            return view('auth.already.verified');
        } else {
            return redirect()->route('verify.index')->with('error', 'User not found.');
        }
    }
    function verified()
    {
        return view('auth.verified');
    }
}
