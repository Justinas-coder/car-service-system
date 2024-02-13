<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Service Details') }}
            </h2>
        </x-slot>
    </div>

    <div class="mx-auto w-full sm:w-2/3 mt-8">
        <table class="flex-1 min-w-full divide-y divide-gray-300">
            <thead>
            <tr>
                <th scope="col"
                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                    Name
                </th>
                <th scope="col"
                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                    Description
                </th>
                <th scope="col"
                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                    Price
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
            <tr>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $service->name }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $service->description }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $service->price }}</td>
            </tr>
            </tbody>
        </table>

    </div>

</x-app-layout>


