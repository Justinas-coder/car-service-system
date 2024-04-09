<?php

namespace App\Services;

use App\Mail\InvoiceEmail;
use App\Models\Order;
use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Spatie\Browsershot\Browsershot;

class InvoiceMailService
{
    public function sendInvoiceEmail(Order $order): string
    {
        $html = view("mail.client.invoice-email", [
            'order' => $order
        ])->render();

        $pdfPath = storage_path("app/invoice_{$order->id}.pdf");

        Browsershot::html($html)->save($pdfPath);

        Mail::to($order->user->email)->send(new InvoiceEmail($order));

        return $pdfPath;
    }
}
