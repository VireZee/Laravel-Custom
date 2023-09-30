<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    function index()
    {
        return view('register');
    }
    function register(Request $r)
    {
        $val = $r->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'role' => 'required|in:Owner,CEO,Manager,HR,Employee'
        ], [
            'name.required' => 'Please enter a name.',
            'username.required' => 'Please enter a username.',
            'username.unique' => 'The username has already been taken.',
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'The password must be at least 4 characters.',
            'role.in' => 'Select a valid role.'
        ]);
        $user = new User([
            'name' => $r->input('name'),
            'username' => $r->input('username'),
            'email' => $r->input('email'),
            'password' => Hash::make($r->input('password')),
            'role' => $r->input('role')
        ]);
        $user->created = now()->format('d F Y, h:i:s.u A');
        $user->save();
        return redirect()->route('index');
    }
}
