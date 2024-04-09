<?php

namespace App\Services;

use App\Mail\InvoiceEmail;
use App\Mail\PaymentReceivedMail;
use App\Models\Order;
use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use Spatie\Browsershot\Browsershot;

class PaymentSuccessMailService
{
    public function sendSuccessEmail(Order $order): string
    {

        $html = view("mail.client.payment-received-mail", [
            'order' => $order
        ])->render();

        $pdfPath = storage_path("app/recipe_{$order->id}.pdf");

        Browsershot::html($html)->save($pdfPath);

        Mail::to($order->user->email)->send(new PaymentReceivedMail($order));

        return $pdfPath;
    }
}
