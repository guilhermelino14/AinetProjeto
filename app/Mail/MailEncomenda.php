<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailEncomenda extends Mailable
{
    use Queueable, SerializesModels;

    public $encomenda;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($encomenda)
    {
        $this->encomenda = $encomenda;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('MagicShirt@mailtrap.io')
        ->subject('Encomenda de MagicShirst')
        ->view('email.encomenda');
    }
}
