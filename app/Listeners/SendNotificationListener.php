<?php

namespace App\Listeners;

use App\Events\StripePaimentProcessed;
use App\Models\Order;
use App\Services\InvoiceMailService;
use App\Services\PaymentSuccessMailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationListener
{
    protected PaymentSuccessMailService $paymentSuccessMailService;

    public function __construct(PaymentSuccessMailService $paymentSuccessMailService)
    {
        $this->paymentSuccessMailService = $paymentSuccessMailService;
    }

    public function handle(StripePaimentProcessed $event)
    {
        $this->paymentSuccessMailService->sendSuccessEmail($event->order);

        return back()->with('success', 'Receipt has been sent successfully!');
    }
}
