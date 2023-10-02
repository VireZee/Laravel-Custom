@extends('index')
@section('content')
    <div class="container">
        <p>Click the button below to verify your email address:</p>
        <a href="{{ $verify_token }}" class="btn btn-primary">Verify Email</a>
    </div>
@endsection