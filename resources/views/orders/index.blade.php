<x-app-layout>
    <x-page-section-header>
        {{ 'Create new order' }}
    </x-page-section-header>


    <div x-data="orderForm"
         x-on:open-modal.window="open = true"
         x-on:keyup.escape.window="open = false"
         class="relative z-10"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true"
         x-cloak>

        <div x-show="open">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                    <div x-on:click.outside="open = false"
                         class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Are you sure you want to delete? </h3>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="button"
                                    class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto"
                                    @click="deleteOrder()">
                                Delete
                            </button>
                            <button x-on:click="open = false"
                                    type="button"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                <div class="flex-1 ml-8">
                    <x-form.label name="Services"/>
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
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $order->service->name ?? ''}}</td>
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
                                <button @click="selectedOrder = {{ $order->id }};open = true;"
                                        class="inline-flex items-center rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">
                                    Delete
                                </button>
                            </td>
                        @endif
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function orderForm() {
            return {
                open: false,
                selectedOrder: null,
                vehicleMake: '',
                vehicleModel: '',
                vehicleModels: [],
                onMakeChange() {
                    axios.get('/api/makes/' + this.vehicleMake + '/models')
                        .then(res => {
                            this.vehicleModels = res.data;
                            console.log((this.vehicleModels))
                        });
                },
                deleteOrder() {
                    document.querySelector('#delete-order-{{ $order->id }}').submit();
                }
            }
        }
    </script>
</x-app-layout>


