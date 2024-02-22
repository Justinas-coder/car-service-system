<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceEmail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function sendInvoiceEmail(Order $order)
    {
//        return view('mail.invoice-email',[
//            'order' => $order
//        ]);
//
        Mail::to($order->user->email)->send(new InvoiceEmail($order));

        $pdf = Pdf::loadView('mail.invoice-email',[
            'order' => $order
        ]);

        return $pdf->stream($order->id. '.pdf');

//        return back()->with('success', 'Invoice has been sent successfully!');;
    }

    public function download(Order $order ) {
        $pdf = Pdf::loadView('mail.invoice-email',[
            'order' => $order
        ]);

        return $pdf->stream($order->id. '.pdf');
    }
}
