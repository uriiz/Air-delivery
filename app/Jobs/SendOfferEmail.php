<?php

namespace App\Jobs;

use App\Mail\SendOffer;
use App\Offer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendOfferEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $user;
    private $offer;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,Offer $offer)
    {
        $this->user = $user;
        $this->offer = $offer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user)->send(new SendOffer($this->user,$this->offer));
    }
}
