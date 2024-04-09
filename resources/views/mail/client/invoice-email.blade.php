<x-mail-client-layout>

    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
        <div class="sm:w-11/12 lg:w-3/4 mx-auto">
            <div class="flex flex-col p-4 sm:p-10 bg-white shadow-md rounded-xl dark:bg-gray-800">
                <div class="flex justify-between">
                    <div>
                        <h1 class="mt-2 text-lg md:text-xl font-semibold text-blue-600 dark:text-white">Car Service
                            System.</h1>
                    </div>
                    <div class="text-end">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-gray-200">Invoice
                            # {{ $order->id }}</h2>
                        <span class="mt-1 block text-gray-500">3682303</span>
                        <address class="mt-4 not-italic text-gray-800 dark:text-gray-200"
                        >
                            Motor street<br>
                            128 a. Block 8a.<br>
                            Vilnius, Lithuania, 920567<br>
                        </address>
                    </div>
                </div>
                <div class="mt-8 grid sm:grid-cols-2 gap-3">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Bill to:</h3>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Car Service System</h3>
                        <address class="mt-2 not-italic text-gray-500">
                            Motor street,<br>
                            128 a. Block 8a<br>
                            Vilnius, Lithuania, 920567<br>
                            Bank Swedbank A/N LT342342343234<br>
                        </address>
                    </div>
                    <!-- Col -->
                    <div class="sm:text-end space-y-2">
                        <!-- Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Invoice date:</dt>
                                <dd class="col-span-2 text-gray-500">{{ now()->format('Y-m-d') }}</dd>
                            </dl>
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Due date:</dt>
                                <dd class="col-span-2 text-gray-500">{{ now()->addWeek()->format('Y-m-d') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                    Service
                                    Name
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Description
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Price
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            @foreach($order->services as $service)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                        {{ $service->name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $service->description }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $service->price }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-8 flex sm:justify-end">
                    <div class="w-full max-w-2xl sm:text-end space-y-2">
                        <dl class="grid sm:grid-cols-5 gap-x-3">
                            <dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Tax:</dt>
                            <dd class="col-span-2 text-gray-500">{{ $order->total_tax }}</dd>
                        </dl>
                        <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Total:</dt>
                                <dd class="col-span-2 text-gray-500">{{ $order->total_price }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="mt-8 sm:mt-12">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Thank you!</h4>
                    <p class="text-gray-500">If you have any questions concerning this invoice, use the following
                        contact
                        information:</p>
                    <div class="mt-2">
                        <p class="block text-sm font-medium text-gray-800 dark:text-gray-200">{{ config('mail.from.primary') }}</p>
                        <p class="block text-sm font-medium text-gray-800 dark:text-gray-200">+1 (062) 109-9222</p>
                    </div>
                </div>
                <p class="mt-5 text-sm text-gray-500">© {{ now()->format('Y') }} {{ config('app.name') }}.</p>
            </div>
        </div>
    </div>

</x-mail-client-layout>
