<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoiceData;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Order $order,
    ){}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            new Address(config('mail.from.primary')),
            subject: sprintf(' Order - %s Invoice', $this->order->id),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.invoice-email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
//        $pdfPath = "app/{$this->order->id}.pdf";
//
//        return [
//            Attachment::fromStorage($pdfPath),
//        ];
        return [
            Attachment::fromPath(storage_path("app/{$this->order->id}.pdf")),
        ];
    }
}
