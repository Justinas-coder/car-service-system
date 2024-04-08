<?php

use App\Mail\InvoiceEmail;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Models\VehicleMake;
use App\Services\InvoiceMailService;
use function Pest\Laravel\{actingAs};
use Illuminate\Foundation\Testing\RefreshDatabase;


describe('test invoice mail has been send successful', function () {

    it('sends invoice email and saves PDF successfully', function () {

       $user = User::factory()->createOne();

        $order = Order::factory()->for($user)->has(Service::factory()->count(3))->createOne();

        $emailService = new InvoiceMailService();

        Mail::fake();

        $pdfPath = $emailService->sendInvoiceEmail($order);

        Mail::assertSent(InvoiceEmail::class, function ($mail) use ($order) {
            return $mail->hasTo($order->user->email) && $mail->assertSeeInHtml($order->id);
        });
    });

});

