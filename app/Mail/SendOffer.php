<?php

namespace App\Mail;

use App\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOffer extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $offer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$offer)
    {
        $this->user = $user;
        $this->offer = $offer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $offer = $this->offer;

        $url = env("APP_URL", url());
        return $this->markdown('emails.offers.sending',compact('user','url','offer'));
    }
}
