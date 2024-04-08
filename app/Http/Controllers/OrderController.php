<?php

namespace App\Http\Controllers;


use App\Enums\OrderStatus;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Service;
use App\Models\VehicleMake;
use App\Services\OrderService;
use App\Services\ServiceModelService;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

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

        $order = $this->orderService->createOrder(
            auth()->id(),
            $request->make_id,
            $request->model_id,
            $request->year,
            $services
        );

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully!');
    }

    public function show(Order $order)
    {
        return view('order.show', [
            'order' => $order,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        if ($request->services) {
            $services = explode(',', $request->services);

            $order->services()->sync(ids: $services);
        }

        $totalPrice = (new ServiceModelService())->calculateTotalPrice($order->services->pluck('id'));

        $order->update([
            'vehicle_make_id' => $request->make_id ?? $order->vehicle_make_id,
            'vehicle_model_id' => $request->model_id ?? $order->vehicle_model_id,
            'year' => $request->year ?? $order->year,
            'status' => $request->status ?? $order->status,
            'total_price' => $totalPrice
        ]);

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
