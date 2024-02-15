<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ strtoupper($vehicleMake->title) }}
            </h2>
        </x-slot>
    </div>
    <div class="mx-auto w-full sm:w-2/3 mt-8"
         x-data="modelForm"
         x-on:open-create-vehicle-model-modal.window="openCreateModal = false"
         x-on:open-modal.window="openDeleteModal = false"
         x-on:keyup.escape.window="openCreateModal = false"
         x-on:keyup.escape.window="openDeleteModal = false"
         x-cloak>
        <div class="flex justify-between">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Models</h1>
            </div>
            <div class="justify-end mt-4 sm:mt-0">
                <button
                    x-on:click="openCreateModal = true"
                    type="button"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Add New Model
                </button>
            </div>
        </div>

        <x-modal>Are you sure you want to delete?</x-modal>

        <x-create-vehicle-model-modal/>

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="mx-auto w-full sm:w-2/3 mt-8">
                        @if($vehicleMake)
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                    Title
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                    Created At
                                </th>
                                <th scope="col" class=""><span class="sr-only">Details</span>
                                </th>
                                </thead>
                                <tbody class="bg-white">
                                @foreach($vehicleMake->models as $model)
                                    <tr class="even:bg-gray-50 cursor-pointer">
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $model->title ?? '' }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $model->created_at ?? ''}}</td>
                                        @if(Gate::allows('isAdmin'))
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-3">
                                                <a href="{{ route('models.edit', $model->id) }}"
                                                   class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            </td>
                                            <td class="relative whitespace-nowrap py-4 pr-4 text-center text-sm font-medium sm:pr-3">
                                                <form id="delete-model-{{ $model->id }}"
                                                      method="POST"
                                                      action="{{ route('models.destroy', $model->id) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                </form>
                                                <x-danger-button
                                                    @click="selectedModel = {{ $model->id }};openDeleteModal = true;"
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
                            <p>No vehicles found.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function modelForm() {
            return {
                openDeleteModal: false,
                openCreateModal: false,
                vehicleModel: '',
                vehicleMake: @json($vehicleMake->id),
                selectedModel: '',

                submitForm() {
                    axios.post('/api/makes/' + this.vehicleMake + '/models', {title: this.vehicleModel})
                        .then(response => {
                            window.location.reload()
                        }).catch(error => {
                        console.error(error.response.data);
                    });
                },

                deleteRecord() {
                    document.querySelector(`#delete-model-${this.selectedModel}`).submit();
                },
            }
        }
    </script>
</x-app-layout>


