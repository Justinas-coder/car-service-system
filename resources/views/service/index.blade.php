<x-app-layout>

    <div x-data="serviceForm"
         x-on:open-modal.window="openDeleteModal = false"
         x-on:open-create-service-modal.window="openCreateService = false"
         x-on:keyup.escape.window="openDeleteModal = false"
         x-on:keyup.escape.window="openCreateService = false"
         class="relative z-10"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true"
         x-cloak>

        <x-modal>Are you sure you want to delete?</x-modal>

        <div class="flex justify-between mx-auto w-full sm:w-2/3 mt-8">
            <x-page-section-header>
                {{ 'Services list' }}
            </x-page-section-header>

            <div class="justify-end mt-4 sm:mt-0">
                <a href="{{ route('services.create') }}">
                    <button
                        type="button"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        Add New Service
                    </button>
                </a>
            </div>
        </div>
        <div class="mx-auto w-full sm:w-2/3 mt-8">
            @if(count($services) > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Name</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Description</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Price</th>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($services as $service)
                        <tr class="even:bg-gray-50 cursor-pointer">
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $service->name ?? '' }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $service->description ?? '' }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $service->price ?? ''}}</td>
                            @if(Gate::allows('isAdmin'))
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-3">
                                    <a href="{{ route('services.edit', $service->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pr-4 text-center text-sm font-medium sm:pr-3">
                                    <form id="delete-service-{{ $service->id }}"
                                          method="POST"
                                          action="{{ route('services.destroy', $service->id) }}">
                                        @csrf
                                        @method('DELETE')

                                    </form>
                                    <x-danger-button
                                        @click="selectedService = {{ $service->id }};openDeleteModal = true;"
                                        class="inline-flex items-center rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">
                                        Delete
                                    </x-danger-button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No orders found.</p>
            @endif
        </div>
    </div>

    <script>
        function serviceForm() {
            return {
                openDeleteModal: false,
                selectedService: '',

                deleteRecord() {
                    document.querySelector(`#delete-service-${this.selectedService}`).submit();
                },
            }
        }
    </script>
</x-app-layout>


