<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit model') }} {{ strtoupper($model->title) }}
            </h2>
        </x-slot>
    </div>
    <div class="mx-auto max-w-fit mt-8">
        <form action="{{ route('admin.vehicle-makes.models.update', $model->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            <x-form.input name="title" :value="old('title', $model->title)" required/>
            <x-form.button>Update</x-form.button>
        </form>

    </div>
</x-app-layout>


