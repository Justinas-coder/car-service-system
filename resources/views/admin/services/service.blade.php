<x-app-layout>
    <div>
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select a tab</label>
            <select id="tabs" name="tabs"
                    class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option>Vehicle Makes</option>
                <option>Vehicle Models</option>
                <option>Services</option>
            </select>
        </div>
        <div class="hidden sm:block">
            <div class="">
                <nav class="flex justify-center space-x-20 " aria-label="Tabs">
                    <x-admin-nav-link :href="route('admin.vehicle-make.index')"
                                      :active="request()->routeIs('admin.vehicle-make.index')">
                        {{ __('Vehicle Makes') }}
                    </x-admin-nav-link>
                    <x-admin-nav-link :href="route('admin.vehicle-model.index')"
                                      :active="request()->routeIs('admin.vehicle-model.index')">
                        {{ __('Vehicle Models') }}
                    </x-admin-nav-link>
                    <x-admin-nav-link :href="route('admin.service.index')"
                                      :active="request()->routeIs('admin.service.index')">
                        {{ __('Services') }}
                    </x-admin-nav-link>
                </nav>
            </div>
        </div>
        <div>
            test 3
        </div>
    </div>

</x-app-layout>


