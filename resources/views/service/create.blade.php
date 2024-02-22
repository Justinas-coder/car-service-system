<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create new Service') }}
            </h2>
        </x-slot>
    </div>
    <div class="mx-auto max-w-fit mt-8">
        <form action="{{ route('services.store') }}" method="POST">
            @csrf

            <x-form.input name="name" required />
            <x-form.textarea name="description" />
            <x-form.input-integer name="price" required />
            <x-form.button>Save</x-form.button>
        </form>
    </div>
</x-app-layout>
