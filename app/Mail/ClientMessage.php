<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $fromEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fromEmail)
    {
        $this->fromEmail=$fromEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromEmail)
                    ->view('email');
    }
}
