<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $mailSubject;
    private $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $mailSubject, $content)
    {
        $this->user = $user;
        $this->mailSubject = $mailSubject;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->mailSubject)
            ->markdown('emails.ticket_mail', ['content' => $this->content]);
    }
}
