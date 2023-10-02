@extends('index')
@section('title', 'Verify')
@section('content')
<div class="container">
    <div class="alert alert-success">
        <p>Check the email for verification.</p>
    </div>
    <p>If you need to resend the verification email, please click <a href="{{ route('reverify', ['verify_token' => $verify_token]) }}">here</a>.</p>
</div>
@endsection