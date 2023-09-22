<?php

namespace App\Jobs;

use App\Mail\PurchaseProductEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPurchaseProductEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    public $tries = 5;

    /**
     * Create a new job instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $details = new PurchaseProductEmail($this->details);
        Mail::to($this->details['email'])->send($details);
    }
}
