<?php

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Models\VehicleMake;
use function Pest\Laravel\{actingAs};
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->service = Service::factory()->createOne();

    $this->make = VehicleMake::create([
        'title' => fake()->name()
    ]);

    $this->makeModel = $this->make->models()->create([
        'title' => fake()->name()
    ]);

    $this->order = Order::factory()->has(Service::factory()->count(3))->createOne();

});

describe('test order posted to stripe checkout successful', function () {

    it('post to checkout redirects to Stripe', function () {

        \Pest\Laravel\post(route('cart.checkout', [
            'order' => $this->order
        ]))

        ->assertRedirect();
    });

    it('session_id is saved to order after checkout', function () {

        $checkoutService = new \App\Services\StripeCheckoutService();

        $checkoutData = $checkoutService->processCheckout($this->order);

        expect($this->order->session_id)->not->toBeNull();

    });
});

