<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAnonymousUserRegistrationMailToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;
    public $password;
    public function __construct($user, $token, $password)
    {
        $this->user = $user;
        $this->token = $token;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.anonymousEmailVerificationEmail')->subject('Welcome to merchant Bay Ltd')->with(['user' => $this->user, 'token' => $this->token, 'password' => $this->password]);
    }
}
