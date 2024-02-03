<?php

namespace App\Http\Controllers;


use App\Enums\OrderStatus;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Service;
use App\Models\VehicleMake;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;


class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'orders' => Order::query()->where('user_id', auth()->id())->get(),
            'vehicleMakes' => VehicleMake::all(),
            'services' => Service::all(),
        ]);
    }

    public function edit(Order $order)
    {
        return view('orders.edit', [
            'order' => new OrderResource($order),
            'vehicleMakes' => VehicleMake::all(),
            'services' => Service::all(),
        ]);
    }

    public function create()
    {
        return view('orders.create-new', [
            'vehicleMakes' => VehicleMake::all(),
            'services' => Service::all(),
        ]);
    }

    public function store(StoreOrderRequest $request)
    {
        Order::create([
            'user_id' => auth()->id(),
            'vehicle_make_id' => $request->make_id,
            'vehicle_model_id' => $request->model_id,
            'year' => $request->year,
            'service_id' => $request->service_id,
            'status' => OrderStatus::IN_PROGRESS,
            'total_price' => Service::query()->where('id', $request->service_id)->value('price')
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully!');
    }

    public function show(Order $order)
    {
        return view('orders.show', [
            'order' => $order
        ]);
    }

    public function update(Order $order, Request $request)
    {

        $order->update([
            'vehicle_make_id' => $request->make_id,
            'vehicle_model_id' => $request->model_id,
            'year' => $request->years,
            'service_id' => $request->service_id,
            'status' => $request->status,
        ]);

        return redirect()->route('orders.index')
            ->with('success', "Order  {$order->service->title} updated successfully!");
    }

    public function destroy(Order $order)
    {
        dd('test');
    }
}
