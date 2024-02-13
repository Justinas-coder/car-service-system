<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit service') }} {{ strtoupper($service->name) }}
            </h2>
        </x-slot>
    </div>
    <div class="mx-auto max-w-fit mt-8">
        <form action="{{ route('services.update', $service->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            <x-form.input name="name" :value="old('name', $service->name)" required/>
            <x-form.input name="description" :value="old('description', $service->description)" required/>
            <x-form.input name="price" :value="old('price', $service->price)" required/>
            <x-form.button>Update</x-form.button>
        </form>

    </div>
</x-app-layout>
