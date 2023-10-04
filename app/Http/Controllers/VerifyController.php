<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyController extends Controller
{
    function index(Request $r)
    {
        return view('verification.verify', ['verify_token' => $r->verify_token]);
    }
    function reverify()
    {
        $user = Auth::user();
        $verify_token = $user->verify_token;
        Mail::send('email.verification', ['verify_token' => $verify_token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Email Verification');
        });
        return redirect()->route('verify.index', ['verify_token' => $verify_token]);
    }
    function verify(User $verify_token)
    {
        $user = User::where('verify_token', $verify_token)->first();
        if ($user->verify_token === $verify_token) {
            $user->is_verified = true;
            $user->verified = now()->format('d F Y, h:i:s.u A');
            $user->verify_token = null;
            $user->save();
            return redirect()->route('verified');
        } else if ($verify_token !== $user->verify_token && $user->is_verified === false) {
            return view('verification.invalid');
        } else if ($verify_token !== $user->verify_token && $user->is_verified === true) {
            return view('verification.already.verified');
        } else {
            return redirect()->route('verify.index')->with('error', 'User not found.');
        }
    }
    function verified()
    {
        return view('verification.verified');
    }
}
