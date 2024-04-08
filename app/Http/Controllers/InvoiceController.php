<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceEmail;
use App\Models\Order;
use App\Services\InvoiceMailService;
use Illuminate\Support\Facades\Mail;
use Spatie\Browsershot\Browsershot;

class InvoiceController extends Controller
{
    protected $invoiceMailService;

    public function __construct(InvoiceMailService $invoiceMailService)
    {
        $this->invoiceMailService = $invoiceMailService;
    }

    public function sendInvoiceEmail(Order $order)
    {
        $this->invoiceMailService->sendInvoiceEmail($order);

        return back()->with('success', 'Invoice has been sent successfully!');
    }
}
