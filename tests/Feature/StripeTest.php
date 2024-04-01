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

});

describe('test order posted to stripe checkout successful', function () {

    it('test creates order successful', function () {

        actingAs(User::factory()->createOne());

        $orderRequest = [
            'make_id' => $this->make->id,
            'model_id' => $this->makeModel->id,
            'year' => 2023,
            'services' => $this->service->id,
        ];

        $request = \Pest\Laravel\post(route('orders.store'), $orderRequest)
            ->assertRedirect();

        $createdOrder = Order::latest()->first();

        expect($createdOrder->vehicle_make_id)->toBe($this->make->id);

    });

    it('post to checkout', function () {

        $createdOrder = Order::factory()->createOne();

        \Pest\Laravel\post(route('cart.checkout', [
            'order' => $createdOrder
        ]))
        ->assertRedirect();
    });

    it('success', function () {

        $createdOrder = Order::factory()->createOne();

        \Pest\Laravel\post(route('cart.checkout', [
            'order' => $createdOrder
        ]))
            ->assertRedirect();
    });


});

