<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Order') }}
            </h2>
        </x-slot>
    </div>

    <div class="mx-auto sm:w-1/3 mt-8">
        <form method="POST" action="{{ route('orders.update', $order->id) }}" enctype="multipart/form-data"
              x-data="orderForm" x-init="initForm">

            @csrf
            @method('PUT')

            <div class="flex-1">
                <x-form.label name="makes"/>
                <select id="make_id"
                        name="make_id"
                        x-model="orderData.vehicle_make_id"
                        x-on:change="onMakeChange"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        required>
                    @foreach($vehicleMakes as $make)
                        <option value="{{ $make->id }}">{{ $make->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 py-3">
                <x-form.label name="models"/>
                <select id="model_id" name="model_id" x-model="orderData.vehicle_model_id"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        required>
                    <template x-for="vehicleModel in vehicleModels" :key="vehicleModel.id">
                        <option :value="vehicleModel.id" x-text="vehicleModel.title"></option>
                    </template>
                </select>
            </div>
            <div class="flex-1 py-3">
                <x-form.label name="years"/>
                <select id="years" name="years" x-model="orderData.years"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        required>
                    @for($year = date("Y"); $year >= 1900; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex-1 py-3">
                <x-form.label name="Total price"/>
                <span
                    id="price"
                    x-text="orderData.total_price"
                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required></span>
            </div>
            <div class="flex-1">
                <x-form.label name="status"/>
                <select id="status"
                        name="status"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        required>
                    @foreach(\App\Enums\OrderStatus::options() as $key => $value)
                        <option value="{{ $key }}" @if($order->status->value === $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 py-3">
                <x-form.label name="order date"/>
                <span
                    id="date"
                    x-text="date"
                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required></span>
            </div>

            <x-form.multi-select :services="$order->services()->pluck('id')->toArray()" required></x-form.multi-select>

            <x-form.button>Update</x-form.button>
        </form>
    </div>
    <script>
        function orderForm() {
            return {
                // orderData: $order,
                orderData: @json($order),
                vehicleModels: [],
                description: null,
                total_price: null,
                date: null,


                getModelsForMake(make) {
                    axios.get(`/api/makes/${make}/models`)
                        .then(res => {
                            this.vehicleModels = res.data.data;
                        });
                },
                onMakeChange() {
                    this.getModelsForMake(this.orderData.vehicle_make_id)
                },

                onServiceChange() {
                    axios.get(`/api/services/${this.orderData.service_id}`)
                        .then(res => {
                            this.description = res.data.data.description;
                        });
                },
                initForm() {
                    this.date = this.orderData.order_date;
                    console.log(this.orderData)

                    this.getModelsForMake(this.orderData.vehicle_make_id)
                },
            }
        }
    </script>
</x-app-layout>




