<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit make') }} {{ strtoupper($make->title) }}
            </h2>
        </x-slot>
    </div>
    <div class="mx-auto max-w-fit mt-8">
        <form action="{{ route('admin.vehicle-make.update', $make->id) }}"
              method="POST">
            @csrf
            @method('PATCH')

                <x-form.input name="title" :value="old('title', $make->title)" required />
                <x-form.button>Update</x-form.button>
        </form>

    </div>
</x-app-layout>


