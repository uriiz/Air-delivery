<?php

namespace App\Jobs;

use App\Mail\SendPriceOffer;
use App\Response;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendPriceOfferEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $user;
    private $response;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Response $response,User $user)
    {
        $this->user = $user;
        $this->response = $response;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user)->send(new SendPriceOffer($this->user,$this->response));
    }
}
