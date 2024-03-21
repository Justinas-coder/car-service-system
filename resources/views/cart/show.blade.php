<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Checkout details') }}
            </h2>
        </x-slot>
    </div>
    <main class="mx-auto max-w-2xl pb-24 pt-8 sm:px-6 sm:pt-16 lg:max-w-7xl lg:px-8">
        <div class="space-y-2 px-4 sm:flex sm:items-baseline sm:justify-between sm:space-y-0 sm:px-0">
            <div class="flex sm:items-baseline sm:space-x-4">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Order # {{ $order->id }}</h1>
                <a href="#" class="hidden text-sm font-medium text-indigo-600 hover:text-indigo-500 sm:block">
                    View invoice
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
            <p class="text-sm text-gray-600">Order placed
                <time datetime="2021-03-22"
                      class="font-medium text-gray-900">{{ $order->created_at->format('Y-m-d') }}</time>
            </p>
            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 sm:hidden">
                View invoice
                <span aria-hidden="true"> &rarr;</span>
            </a>
        </div>

        <!-- Products -->
        <section aria-labelledby="products-heading" class="mt-6">
            <h2 id="products-heading" class="sr-only">Products purchased</h2>
            <table class="min-w-full divide-y divide-gray-300">
                <thead>
                <tr>
                    <th scope="col"
                        class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                        Service Name
                    </th>
                    <th scope="col"
                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                        Description
                    </th>
                    <th scope="col"
                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Price
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($order->services as $service)
                    <tr>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $service->name  }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $service->description }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $service->price }} Eur</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </section>

        <!-- Billing -->
        <section aria-labelledby="summary-heading" class="mt-16">
            <h2 id="summary-heading" class="sr-only">Billing Summary</h2>

            <div class="bg-gray-100 px-4 py-6 sm:rounded-lg sm:px-6 lg:grid lg:grid-cols-12 lg:gap-x-8 lg:px-8 lg:py-8">
                <dl class="grid grid-cols-2 gap-6 text-sm sm:grid-cols-2 md:gap-x-8 lg:col-span-7">
                    <div>
                        <dt class="font-medium text-gray-900">Billing address</dt>
                        <dd class="mt-3 text-gray-500">
                            <span class="block">Motor street</span>
                            <span class="block">128 a. Block 8a.</span>
                            <span class="block">Vilnius, Lithuania, 920567</span>
                        </dd>
                    </div>
                    <div>
                        <div class="font-medium text-gray-900">Payment type</div>
                        <div class="mt-4">
                            <a href="{{ route('invoice.invoice-send', $order->id) }}"
                               class="inline-block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            >Get Invoice by email</a>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('cart.show', $order->id) }}"
                               class="inline-block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            >Pay Now</a>
                        </div>
                    </div>
                </dl>

                <dl class="mt-8 divide-y divide-gray-200 text-sm lg:col-span-5 lg:mt-0">
                    <div class="flex items-center justify-between py-4">
                        <dt class="text-gray-600">Tax</dt>
                        <dd class="font-medium text-gray-900">${{ $order->total_tax }}</dd>
                    </div>
                    <div class="flex items-center justify-between pt-4">
                        <dt class="font-medium text-gray-900">Order total</dt>
                        <dd class="font-medium text-indigo-600">${{ $order->total_price }}</dd>
                    </div>
                </dl>
            </div>
    </main>

</x-app-layout>


