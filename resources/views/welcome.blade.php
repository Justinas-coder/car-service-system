<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->

</head>
<body class="antialiased">
<div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/orders/create') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="relative bg-white">
        <img class="h-56 w-full bg-gray-50 object-cover lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-1/2"
             src="{{ asset('assets/images/front_photo.jpg') }}" alt="">
        <div class="mx-auto grid max-w-7xl lg:grid-cols-2">
            <div class="px-6 pb-24 pt-16 sm:pb-32 sm:pt-20 lg:col-start-2 lg:px-8 lg:pt-32">
                <div class="mx-auto max-w-2xl lg:mr-0 lg:max-w-lg">
                    <h2 class="text-base font-semibold leading-8 text-indigo-600">Get Ready for a Smooth Ride!</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">We’re here to help</p>
                    <p class="mt-6 text-lg leading-8 text-gray-600">Experience the Ease of Car Care! Make an order and
                        elevate your car's maintenance journey.</p>
                    <dl class="mt-16 grid max-w-xl grid-cols-1 gap-8 sm:mt-20 sm:grid-cols-2 xl:mt-16">
                        <div class="flex flex-col gap-y-3 border-l border-gray-900/10 pl-6">
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">Effortless
                                Ordering
                            </dd>
                        </div>
                        <div class="flex flex-col gap-y-3 border-l border-gray-900/10 pl-6">
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">Transparent
                                Pricing
                            </dd>
                        </div>
                        <div class="flex flex-col gap-y-3 border-l border-gray-900/10 pl-6">
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">History Access
                            </dd>
                        </div>
                        <div class="flex flex-col gap-y-3 border-l border-gray-900/10 pl-6">
                            <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">
                                Expert Maintenance
                            </dd>
                        </div>
                    </dl>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        @auth()
                            <a href="{{ url('/orders') }}"
                               class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Order Now!
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Order Now!
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</body>
</html>
