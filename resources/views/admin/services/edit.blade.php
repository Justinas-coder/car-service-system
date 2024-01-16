<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Service') }} {{ strtoupper($service->name) }}
            </h2>
        </x-slot>
    </div>
    <div class="mx-auto max-w-fit mt-8">
        <form action="{{ route('admin.service.update', $service->id) }}"
              method="POST">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="old('name', $service->name)" required/>
            <x-form.textarea name="description"
                             required>{{ old('description', $service->description) }}</x-form.textarea>
            <x-form.input name="price" :value="old('price', $service->price)" required/>
            <x-form.button>Update</x-form.button>
        </form>
    </div>
</x-app-layout>


