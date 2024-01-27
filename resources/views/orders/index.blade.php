<x-app-layout>
    <x-page-section-header>
        {{ 'Create new order' }}
    </x-page-section-header>
    <div class="py-10 mx-auto w-full sm:w-2/3">
        <form class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex" x-data="{
            vehicleMake: null,
            vehicleModel: null,
            vehicleModels: [],
            onMakeChange(event) {
                axios.get(`/api/makes/${event.target.value}/models`).then(res => {
                    this.vehicleModels = res.data
                    console.log(this.vehicleModels)
                })
            }
        }" method="POST" action="{{ route('orders.store') }}">
            @csrf
            <div class="flex-1">
                <label for="make_id" class="block text-sm font-medium leading-6 text-gray-900">Makes</label>
                <select id="make_id" name="make_id" x-model="vehicleMake" x-on:change="onMakeChange"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        required>
                    <option value="">Chose make</option>
                    @foreach($vehicleMakes as $make)
                        <option :value="{{ $make->id }}">{{ $make->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 ml-8"> <!-- Adjust the margin as needed -->
                <label for="model_id" class="block text-sm font-medium leading-6 text-gray-900">Models</label>
                <select id="model_id" name="model_id" x-model="vehicleModel"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        required>
                    <option value="">Chose model</option>
                    <template x-for="vehicleModel in vehicleModels.data" :key="vehicleModel.id">
                        <option :value="vehicleModel.id" x-text="vehicleModel.title"></option>
                    </template>
                </select>
            </div>
            <div class="flex-1 ml-8">
                <label for="year" class="block text-sm font-medium leading-6 text-gray-900">Year</label>
                <select id="year" name="year"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        required>
                    <option value="">Choose year</option>
                    @for($year = date("Y"); $year >= 1900; $year--)
                        <option :value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex-1 ml-8">
                <label for="service_id" class="block text-sm font-medium leading-6 text-gray-900">Services</label>
                <select id="service_id" name="service_id"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        required>
                    <option value="">Chose service</option>
                    @foreach($services as $service)
                        <option :value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex ml-8 items-end">
                <x-primary-button>
                    {{'Submit'}}
                </x-primary-button>
            </div>
        </form>
    </div>
    <x-page-section-header>
        {{ 'Orders list' }}
    </x-page-section-header>
    <div class="mx-auto w-full sm:w-2/3 mt-8">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Make</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Model</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Year</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Service</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total price</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Order date</th>
            <th scope="col" class=""><span class="sr-only">Details</span>
            </th>
            </th>
            </tr>
            </thead>
            <tbody class="bg-white">
            @foreach($orders as $order)
                <tr class="even:bg-gray-50 cursor-pointer">
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->vehicleMake->title ?? '' }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->vehicleModel->title ?? '' }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->year }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->service->name }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->status }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->total_price }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->created_at }}</td>
                    <td class="relative whitespace-nowrap py-4 pr-4 text-right text-sm font-medium sm:pr-3">
                        <a href="{{ route('current.orders.index', $order->id) }}"
                           class="text-indigo-600 hover:text-indigo-900">Details</a>
                    </td>
                    @if(Gate::allows('isAdmin'))
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                            <a href="{{ route('current.orders.edit', $order->id) }}"
                               class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        </td>
                    @endif
                </tr>

            @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>


