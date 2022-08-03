<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ResetPassword extends Mailable
{
    public string $token;
    public string $email;
    public string $resetPasswordUrl;
    public string $reRequestUrl;

    public function __construct(string $token, string $email)
    {
        $this->token = $token;
        $this->email = $email;
        $this->resetPasswordUrl = sprintf(
            '%s?%s',
            url('/reset-password'),
            http_build_query(['token' => $this->token, 'email' => $this->email])
        );
        $this->reRequestUrl = sprintf(
            '%s?%s',
            url('/forgot-password'),
            http_build_query(['email' => $this->email])
        );
    }

    public function build()
    {
        return $this
            ->subject('Reset Password Notification')
            ->markdown('emails.reset_password');
    }
}
