@push('title', 'Sold Products')


<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Sold Products') }}
        </h2>
    </x-slot>

    <div class="py-12" class="relative z-50 h-auto w-auto">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <div class="flex flex-col">

                    <div class="-m-1.5 overflow-x-auto">
                        <div class="inline-block w-full p-1.5 align-middle">
                            <div class="divide-y divide-gray-200 rounded-lg border dark:divide-gray-700 dark:border-gray-700">

                                <div class="flex items-center justify-between gap-10 px-4 py-3">
                                    <h2 class="my-2 text-xl font-semibold text-gray-800 dark:text-gray-200">
                                        List of Sold Products
                                    </h2>
                                </div>

                                <div>
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col" scope="col">Action</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">
                                                    Product</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">
                                                    Price</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">
                                                    Image</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">
                                                    Serial Number</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">
                                                    Warranty</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">
                                                    Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @forelse ($sold_products as $product)
                                                <tr>
                                                    <td class="whitespace-nowrap px-6 py-4 text-left text-sm font-medium" x-data>
                                                        <a href="{{ route('products.show', $product->serial_number) }}" target="_blank" title="View"><i class="bi bi-eye-fill rounded bg-green-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-green-600"></i></a>
                                                        @if ($product->qr_code)
                                                            <a href="{{ route('products.qr_code', $product->serial_number) }}" target="_blank" title="QR Code"><i class="bi bi-qr-code rounded bg-blue-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-blue-600"></i></a>
                                                        @endif
                                                        <a href="{{ URL::signedRoute('verify_identity_product', $product->serial_number) }}" target="_blank" title="Timeline">
                                                            <i class="bi bi-calendar-week-fill rounded bg-cyan-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-cyan-600"></i>
                                                        </a>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{!! $product->title_wrapped !!}</td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">Tk {{ number_format($product->price, 2) }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        <img alt="Product Image" class="w-10" src="{{ $product->image }}">
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $product->serial_number }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $product->warranty_period . ' ' . $product->warranty_period_unit }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $product->created_at->format('Y-m-d | h:i A') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="py-5 text-center text-red-500" colspan="10">Products empty</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="grid place-items-center">
                                    {{ $sold_products->links('components.pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
