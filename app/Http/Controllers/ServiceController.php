<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services.index', [
            'services' => Service::all()
        ]);
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(StoreServiceRequest $request)
    {
        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service added successfully!');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', [
            'service' => $service
        ]);
    }

    public function update(Service $service, StoreServiceRequest $request)
    {
        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()
            ->route('admin.services.index')
            ->with('success', "Service  {$service->name} updated successfully!");
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', "Service  {$service->name} deleted successfully!");
    }
}
