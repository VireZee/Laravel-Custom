<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyController extends Controller
{
    function index()
    {
        return view('auth.verify');
    }
    function verify()
    {
    }
}