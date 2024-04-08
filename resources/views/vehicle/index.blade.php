<x-app-layout>

    <div x-data="vehicleForm"
         x-on:open-create-vehicle-make-modal.window="openCreateMake = false"
         x-on:open-modal.window="openDeleteModal = false"
         x-on:keyup.escape.window="openCreateMake = false"
         x-on:keyup.escape.window="openDeleteModal = false"
         class="relative z-10"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true"
         x-cloak>

        <x-modal>Are you sure you want to delete?</x-modal>

        <x-create-vehicle-make-modal/>

       <div class="flex justify-between mx-auto w-full sm:w-2/3 mt-8">
           <x-page-section-header>
               {{ 'Vehicles list' }}
           </x-page-section-header>

           <div class="justify-end mt-4 sm:mt-0">
               <button
                   x-on:click="openCreateMake = true"
                   type="button"
                   class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
               >
                   Add New Make
               </button>
           </div>
       </div>

        <div class="mx-auto w-full sm:w-2/3 mt-8">
            @if(count($vehicleMakes) > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Title</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Models</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Created At</th>
                    <th scope="col" class=""><span class="sr-only">Details</span>
                    </th>
                    </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($vehicleMakes as $vehicle)
                        <tr class="even:bg-gray-50 cursor-pointer">
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $vehicle->title ?? '' }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">
                                @foreach($vehicle->models as $model)
                                    <ul>
                                        {{ $model->title }}
                                    </ul>
                                @endforeach
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $vehicle->created_at ?? ''}}</td>
                            @if(Gate::allows('isAdmin'))
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-3">
                                    <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pr-4 text-center text-sm font-medium sm:pr-3">

                                    <form id="delete-vehicle-{{ $vehicle->id }}"
                                          method="POST"
                                          action="{{ route('vehicles.destroy', $vehicle->id) }}">
                                        @csrf
                                        @method('DELETE')

                                    </form>
                                    <x-danger-button @click="selectedVehicle = {{ $vehicle->id }};openDeleteModal = true;"
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

    <script>
        function vehicleForm() {
            return {
                openDeleteModal: false,
                openCreateMake: false,
                vehicle: '',
                selectedVehicle: '',
                vehicleMake: '',

                deleteRecord() {
                    document.querySelector(`#delete-vehicle-${this.selectedVehicle}`).submit();
                },
                submitMakeForm() {
                    axios.post('/api/makes', {title: this.vehicleMake})
                        .then(response => {
                            window.location.reload()
                            console.log(response.data);
                        }).catch(error => {
                        console.error(error.response.data);
                    });
                },
            }
        }
    </script>
</x-app-layout>


