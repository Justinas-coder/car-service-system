<?php

namespace App\Listeners;

use App\Events\StripePaimentProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSuccessfulPaimentNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StripePaimentProcessed $event): void
    {
        //
    }
}
