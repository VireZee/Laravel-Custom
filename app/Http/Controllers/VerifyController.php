<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
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
        Mail::to($user->email)->send(new EmailVerification($user, $user->verify_token));
        return redirect()->route('verify.view');
    }
    function verify($token)
    {
        $user = User::where('verify_token', $token)->first();
        if ($user) {
            $user->verified = now()->format('d F Y, h:i:s.u A');
            unset($user->verify_token);
            $user->save();
            return redirect()->route('verify');
        } else {
            return view('auth.invalid');
        }
    }
    function verified() {
        return view('auth.verified');
    }
}