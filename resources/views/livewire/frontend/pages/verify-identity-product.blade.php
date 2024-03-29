@push('title', 'Verify Product - ' . $product->title . ' - ' . $product->serial_number)

<div class="bg-gray-100 pt-4 dark:bg-gray-900">
    <div class="mx-auto my-16 min-h-screen max-w-screen-sm px-4 sm:px-0">
        <div class="rounded-md border border-blue-500 bg-white px-5 py-5 dark:bg-inherit md:px-10 md:py-10">
            <h1 class="text-2xl md:text-3xl">Timeline Of {{ $product->title }}</h1>
            <span class="text-gray-400">#{{ $product->serial_number }}</span>
            <ol class="relative mt-10 border-l border-gray-300 dark:border-gray-700">
                @foreach ($product->product_profiles as $product_profile)
                    <li class="mb-10 ml-6">
                        <span class="absolute -left-3 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 ring-1 ring-white dark:bg-blue-900 dark:ring-gray-900">
                            <img class="w-6 rounded-full" src="{{ asset($product_profile->profile->logo) }}">
                        </span>
                        <h3 class="mb-1 flex items-center text-lg font-semibold text-gray-900 dark:text-white">
                            <a href="{{ URL::signedRoute('verify_identity', $product_profile->profile->username) }}" target="_blank">{{ $product_profile->profile->name }}</a>
                            @if ($product_profile->profile->user->role_id == 3)
                                <span class="ml-3 mr-2 rounded bg-blue-500 px-2.5 py-0.5 text-sm font-medium text-white dark:bg-blue-500 dark:text-white">Manufacturer</span>
                            @else
                                <span class="ml-3 mr-2 rounded bg-yellow-500 px-2.5 py-0.5 text-sm font-medium text-white dark:bg-yellow-600 dark:text-white">Shop/Reseller</span>
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

                        <span class="{{ $this->warrantyExpired($this->warrantyTill($product_customer->created_at, $product->warranty_period, $product->warranty_period_unit)) ? 'bg-red-500' : 'bg-purple-500' }} inline-block truncate whitespace-nowrap rounded-md px-3 py-1.5 text-xs font-medium text-white">Warranty Till: <strong>{{ $this->warrantyTill($product_customer->created_at, $product->warranty_period, $product->warranty_period_unit)->format('d F, Y') }}</strong></span>
                    </li>
                @endforeach

            </ol>
        </div>
    </div>
</div>
