<div x-show="openCreateMake"
>
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

            <form @submit.prevent="submitMakeForm">
                <div x-on:click.outside="openCreateMake = false"
                     class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8  sm:max-w-lg sm:p-6">
                    <div class="flex-1 sm:items-start">
                        <div>
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Add New Make</h3>
                        </div>
                        <div>
                            <input type="text"
                                   name="vehicleMake"
                                   id="vehicleMake"
                                   x-model="vehicleMake"
                                   class="mt-5 block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   placeholder="Type make title"
                                   required>
                        </div>

                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse justify-center">
                        <button type="submit"
                                class="mt-3 inline-flex w-full items-center justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:ml-3 sm:mt-0 sm:w-auto"
                        >
                            Save
                        </button>
                        <button x-on:click="openCreateMake = false"
                                type="button"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
