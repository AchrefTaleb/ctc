<?php

namespace App\Mail;

use App\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class newUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $token = app(PasswordBroker::class)->createToken($this->user);
        $link = route('password.reset',[$token]);

        return $this->from('support@transfertdecourrier.com')->subject('Bienvenue chez CTC')->markdown('Emails.NewUser',[
            "link" => $link,
            'name' => $this->user->name

        ]);
    }
}
