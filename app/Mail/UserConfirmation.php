<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $messaggio;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newMessage)
    {
      $this->messaggio = $newMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@sito.com')->subject('Messaggio ricevuto!')->view('mail.conferma-utente');
    }
}
