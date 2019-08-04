<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPriceOffer extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $response;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$response)
    {
        $this->user = $user;
        $this->response = $response;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $response = $this->response;
        $url = env("APP_URL", url());
        return $this->markdown('emails.offers.setprice',compact('user','response','url'));
    }
}
