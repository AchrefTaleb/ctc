<?php

namespace App\Mail;

use App\Request;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class expeditionPriceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user ;
    public $request ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@transfertdecourrier.com')->subject('Demande de réexpédition')->markdown('Emails.backend.expeditionprice');
    }
}
