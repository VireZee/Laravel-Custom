<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class EmailVerification extends Mailable
{
    protected $user;
    protected $verifyLink;

    function __construct(User $user)
    {
        $this->user = $user;
        $this->verifyLink = route('verify.view', ['verify_token' => $user->verify_token]);
    }
    function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Verification',
        );
    }
    public function content(): Content
    {
        return new Content(
            view: 'auth.notice',
            with: ['verify_token' => $this->verifyLink]
        );
    }
}