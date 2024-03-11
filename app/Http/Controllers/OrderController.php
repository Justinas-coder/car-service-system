<?php

namespace App\Http\Controllers;


use App\Enums\OrderStatus;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Service;
use App\Models\VehicleMake;
use App\Services\ServiceModelService;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    public function index()
    {
        return view('order.index', [
            'orders' => Order::query()->where('user_id', auth()->id())->get(),
            'vehicleMakes' => VehicleMake::all(),
            'services' => Service::all(),
        ]);
    }

    public function edit(Order $order)
    {
        return view('order.edit', [
            'order' => new OrderResource($order),
            'vehicleMakes' => VehicleMake::all(),
            'services' => Service::all(),
        ]);
    }

    public function store(StoreOrderRequest $request)
    {
        $services = explode(',', $request->services);

        $totalPrice = (new ServiceModelService())->calculateTotalPrice($services);

        $order = Order::create([
            'user_id' => auth()->id(),
            'vehicle_make_id' => $request->make_id,
            'vehicle_model_id' => $request->model_id,
            'year' => $request->year,
            'status' => OrderStatus::NOT_PAID,
            'total_price' => $totalPrice,
            'total_tax' => $totalPrice * 0.21
        ]);

        foreach ($services as $service) {
            $order->services()->attach($service);
        }

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully!');
    }

    public function show(Order $order)
    {
        return view('order.show', [
            'order' => $order,
        ]);
    }

    public function update(Order $order, Request $request)
    {
        $services = explode(',', $request->services);

        $totalPrice = (new ServiceModelService())->calculateTotalPrice($services);

        $order->update([
            'vehicle_make_id' => $request->make_id,
            'vehicle_model_id' => $request->model_id,
            'year' => $request->years,
            'status' => $request->status,
            'total_price' => $totalPrice
        ]);

        $order->services()->detach();

        foreach ($services as $service) {
            $order->services()->attach($service);
        }

        return redirect()->route('orders.index')
            ->with('success', "Order updated successfully!");
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}
