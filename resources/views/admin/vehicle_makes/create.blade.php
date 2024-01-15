<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New vehicle make') }}
            </h2>
        </x-slot>
    </div>
    <div class="mx-auto max-w-fit mt-8">
        <form action="{{ route('admin.vehicle-make.store') }}" method="POST">
            @csrf

                <x-form.input name="title" required />
                <x-form.button>Create</x-form.button>
        </form>

    </div>
</x-app-layout>


