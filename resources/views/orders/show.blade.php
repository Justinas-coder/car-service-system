<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Orde Details') }}
            </h2>
        </x-slot>
    </div>

    <div class="mx-auto w-full sm:w-2/3 mt-8">
        <table class="min-w-full divide-y divide-gray-300">
            <thead>
            <tr>
                <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-0">Make</th>
                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Model</th>
                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Year</th>
                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Service</th>
                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Description</th>
                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Total Price</th>
                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Status</th>
                <th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Order Date</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
            <tr>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->vehicleMake->title }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->vehicleModel->title }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->year }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->service->name }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->service->description }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->total_price }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->status }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->created_at }}</td>
            </tr>

            <!-- More people... -->
            </tbody>
        </table>

    </div>

</x-app-layout>


