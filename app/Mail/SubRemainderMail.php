<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubRemainderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $days;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $days)
    {
        $this->days = $days;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@transfertdecourrier.com')->markdown('Emails.backend.subremainder');
    }
}
