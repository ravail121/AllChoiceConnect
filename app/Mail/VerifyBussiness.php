<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyBussiness extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $url)
    {
        $this->request = $request;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('verify-bussiness.mail.bussiness-notification');
    }
}
