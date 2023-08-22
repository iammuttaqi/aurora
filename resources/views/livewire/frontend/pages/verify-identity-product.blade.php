@push('title', 'Verify Product - ' . $product->title)

<div class="bg-gray-100 pt-4 dark:bg-gray-900">
    <div class="flex min-h-screen flex-col items-center pt-6 sm:pt-0">
        <div>
            <x-authentication-card-logo />
        </div>

        <div class="grid grid-cols-3 px-5">
            <div class="col-span-3 flex items-center justify-center lg:col-span-1 lg:col-start-2">
                <div class="border-1 mt-10 rounded-md border border-gray-500 bg-white px-5 py-5 dark:bg-inherit md:px-10 md:py-10">
                    <h1 class="text-2xl md:text-3xl">Timeline Of {{ $product->title }}</h1>
                    <ol class="relative mt-10 border-l border-gray-300 dark:border-gray-700">
                        @foreach ($product->product_profiles as $product_profile)
                            <li class="mb-10 ml-6">
                                <span class="absolute -left-3 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 ring-1 ring-white dark:bg-blue-900 dark:ring-gray-900">
                                    <img class="w-6" src="{{ asset($product_profile->profile->logo) }}">
                                </span>
                                <h3 class="mb-1 flex items-center text-lg font-semibold text-gray-900 dark:text-white">
                                    <a href="{{ URL::signedRoute('verify_identity', $product_profile->profile->username) }}">{{ $product_profile->profile->name }}</a>
                                    @if ($product_profile->profile->user->role_id == 3)
                                        <span class="ml-3 mr-2 rounded bg-blue-500 px-2.5 py-0.5 text-sm font-medium text-white dark:bg-blue-500 dark:text-white">Manufacturer</span>
                                    @else
                                        <span class="ml-3 mr-2 rounded bg-yellow-500 px-2.5 py-0.5 text-sm font-medium text-white dark:bg-yellow-600 dark:text-white">Shop</span>
                                    @endif
                                </h3>
                                <time class="my-2 block text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $product_profile->created_at->format('F d, Y - h:i A') }}</time>
                            </li>
                        @endforeach

                        @foreach ($product->product_customers as $product_customer)
                            <li class="mb-10 ml-6">
                                <span class="absolute -left-3 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 ring-8 ring-white dark:bg-blue-900 dark:ring-gray-900">
                                    <svg aria-hidden="true" class="h-2.5 w-2.5 text-blue-800 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </span>
                                <h3 class="mb-1 flex items-center text-lg font-semibold text-gray-900 dark:text-white">{{ $product_customer->customer->name }} <span class="ml-3 mr-2 rounded bg-orange-500 px-2.5 py-0.5 text-sm font-medium text-white dark:bg-orange-500 dark:text-white">Customer</span></h3>
                                <time class="my-2 block text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $product_customer->created_at->format('F d, Y - h:i A') }}</time>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>

    </div>
</div>
