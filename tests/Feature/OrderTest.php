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

beforeEach(function () {
    $this->service = Service::factory()->create();

    $this->make = VehicleMake::create([
        'title' => fake()->name()
    ]);

    $this->makeModel = $this->make->models()->create([
        'title' => fake()->name()
    ]);
});

describe('test order actions perform successful', function () {

    it('order index page contains non empty table', function () {
        actingAs(User::factory()->createOne());

        $order = Order::factory()
            ->for(User::factory()->createOne())
            ->has(Service::factory()->count(3))
            ->createOne();

        $response = $this->get(route('orders.index'))
            ->assertStatus(200)
            ->assertSee($order->id);;
    });

    it('test creates order successful', function () {

        actingAs(User::factory()->createOne());

        $orderRequest = [
            'make_id' => $this->make->id,
            'model_id' => $this->makeModel->id,
            'year' => 2023,
            'services' => $this->service->id,
        ];

        $request = \Pest\Laravel\post(route('orders.store'), $orderRequest)
            ->assertRedirect()
            ->assertSessionHas('success', 'Order created successfully!');

        $createdOrder = Order::latest()->first();

        expect($createdOrder->vehicle_make_id)->toBe($this->make->id);

    });

    it('order can be updated', function () {
        actingAs(User::factory()->createOne());

        $order = Order::factory()
            ->for(User::factory()->createOne())
            ->has(Service::factory()->count(3))
            ->createOne();

        $response = $this->patch(route('orders.update', ['order' => $order->id]), ['status' => \App\Enums\OrderStatus::COMPLETED->value, 'year' => 2002]);

        $response->assertRedirect();

        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => \App\Enums\OrderStatus::COMPLETED->value, 'year' => 2002]);

    });

});

