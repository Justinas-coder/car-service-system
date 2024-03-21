<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceEmail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Spatie\Browsershot\Browsershot;

class InvoiceController extends Controller
{
    public function sendInvoiceEmail(Order $order)
    {
        $html = view("mail.invoice-email", [
            'order' => $order])->render();

        Browsershot::html($html)
            ->save(storage_path("app/invoice_{$order->id}.pdf"));

        Mail::to($order->user->email)->send(new InvoiceEmail($order));

        return back()->with('success', 'Invoice has been sent successfully!');;
    }
}
