<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex" x-data="{
            make: null,
            model: null,
            models: [],
            onMakeChange(event) {
                axios.get(`/api/vehicleModels/${event.target.value}`).then(res => {
                    this.models = res.data;
                });
            }
        }" method="POST" action="{{ route('order.store') }}">
            @csrf
            <div class="flex-1">
                <label for="make_id" class="block mb-2 text-sm font-medium">Makes</label>
                <select id="make_id" name="make_id" x-model="make" x-on:change="onMakeChange"
                        class="inline-flex justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <option>Choose vehicle make</option>
{{--                    @foreach($vehicleMakes as $make)--}}
{{--                        <option :value="{{ $make->id }}">{{ $make->title }}</option>--}}
{{--                    @endforeach--}}
                </select>
            </div>
            <div class="flex-1 ml-4"> <!-- Adjust the margin as needed -->
                <label for="model_id" class="block mb-2 text-sm font-medium">Models</label>
                <select id="model_id" name="model_id" x-model="model"
                        class="inline-flex justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <option>Choose vehicle model</option>
                    <template x-for="model in models" :key="model.id">
                        <option :value="model.id" x-text="model.title"></option>
                    </template>
                </select>
            </div>
            <div class="flex-1">
                <label for="service_id" class="block mb-2 text-sm font-medium">Services</label>
                <select id="service_id" name="service_id"
                        class="inline-flex justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <option>Choose service</option>
{{--                    @foreach($services as $service)--}}
{{--                        <option :value="{{ $service->id }}">{{ $service->name }}</option>--}}
{{--                    @endforeach--}}
                </select>
            </div>
            <div class="flex justify-center mt-4">
                <button type="submit" class="px-4 py-2 bg-purple-800 text-white rounded-md hover:bg-blue-700">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
