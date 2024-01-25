<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New service') }}
            </h2>
        </x-slot>
    </div>
    <div class="mx-auto w-full sm:w-2/3 mt-8">
        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf

            <x-form.input name="name" required/>
            <x-form.textarea name="description" required/>
            <x-form.input name="price" required/>

            <x-form.button>Create</x-form.button>
        </form>

    </div>
</x-app-layout>


