<?php

namespace App\Http\Controllers;


use App\Enums\OrderStatus;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Service;
use App\Models\VehicleMake;
use Illuminate\Http\Request;


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
}
