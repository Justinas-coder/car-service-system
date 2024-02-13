<x-app-layout>
    <x-page-section-header>
        {{ 'Create new order' }}
    </x-page-section-header>


    <div x-data="orderForm"
         x-on:open-modal.window="openDeleteModal = true"
         x-on:keyup.escape.window="openDeleteModal = false"
         class="relative z-10"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true"
         x-cloak>

        <x-modal>Are you sure you want to delete?</x-modal>

        <div class="py-8 mx-auto w-full sm:w-2/3">
            <form class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex" method="POST" action="{{ route('orders.store') }}">
                @csrf

                <div class="flex-1">
                    <x-form.label name="makes"/>
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
                    <x-form.label name="models"/>
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
                    <x-form.label name="Year"/>
                    <select id="year" name="year"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                        <option value="">Choose year</option>
                        @for($year = date("Y"); $year >= 1900; $year--)
                            <option :value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>

                <x-form.multi-select required></x-form.multi-select>

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
            @if(count($orders) > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Make</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Model</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Year</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Service</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Status</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Total price</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Order date</th>
                    <th scope="col" class=""><span class="sr-only">Details</span>
                    </th>
                    </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($orders as $order)
                        <tr class="even:bg-gray-50 cursor-pointer">
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $order->vehicleMake->title ?? '' }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $order->vehicleModel->title ?? '' }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $order->year ?? ''}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">
                                @foreach($order->services as $service)
                                    <ul>
                                        {{ $service->name }}
                                    </ul>
                                @endforeach
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $order->status->title() ?? '' }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $order->total_price ?? ''}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $order->created_at }}</td>
                            <td class="relative whitespace-nowrap py-4 pr-4 text-center text-sm font-medium sm:pr-3">
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="text-indigo-600 hover:text-indigo-900">Details</a>
                            </td>
                            @if(Gate::allows('isAdmin'))
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-3">
                                    <a href="{{ route('orders.edit', $order->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pr-4 text-center text-sm font-medium sm:pr-3">
                                    <form id="delete-order-{{ $order->id }}"
                                          method="POST"
                                          action="{{ route('orders.destroy', $order->id) }}">
                                        @csrf
                                        @method('DELETE')

                                    </form>
                                    <x-danger-button @click="selectedOrder = {{ $order->id }};openDeleteModal = true;"
                                                     class="inline-flex items-center rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">
                                        Delete
                                    </x-danger-button>
                                </td>
                            @endif
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No orders found.</p>
            @endif

        </div>
    </div>

    <script>
        function orderForm() {
            return {
                openDeleteModal: false,
                selectedOrder: '',
                vehicleMake: '',
                vehicleModel: '',
                vehicleModels: [],

                multiple: true,
                value: [],
                options: [],

                onMakeChange() {
                    axios.get('/api/makes/' + this.vehicleMake + '/models')
                        .then(res => {
                            this.vehicleModels = res.data;
                            console.log((this.vehicleModels))
                        });
                },
                deleteRecord() {
                    document.querySelector(`#delete-order-${this.selectedOrder}`).submit();
                },
            }
        }
    </script>
</x-app-layout>


