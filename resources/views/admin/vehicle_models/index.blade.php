<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $make->title }} {{ 'models list' }}
            </h2>
        </x-slot>
    </div>

    <div class="mx-auto w-full sm:w-2/3 mt-8">
        {{-- Actions buttons       --}}
        <div class="mb-5 flex justify-end items-center gap-3">
            <a class="inline-block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
               href="{{ route('admin.vehicle-make.models.create', $make->id) }}">
                Create new model
            </a>
        </div>
        {{--  Data table      --}}
        <table class="min-w-full divide-y divide-gray-300">
            <thead>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created At</th>
            <th scope="col" class=""><span class="sr-only">Edit</span>
            </th>
            </tr>
            </thead>
            <tbody class="bg-white">
            @foreach($vehicle_models as $model)
                <tr class="even:bg-gray-50">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                        {{ $model->title }}
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $model->created_at }}</td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>

    </div>

</x-app-layout>


