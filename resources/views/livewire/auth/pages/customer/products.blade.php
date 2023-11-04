@push('title', $customer->name . ' Products')

<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ $customer->name . ' Products' }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto flex max-w-7xl flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="overflow-hidden rounded-lg border dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th colspan="10">
                                        <div class="flex w-full items-start justify-between rounded-t-lg p-5 dark:bg-gray-900">
                                            <div class="flex items-start gap-10">
                                                <div class="text-left">
                                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">List of {{ $customer->name . ' Products' }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                </tr>

                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Action</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Serial Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Warranty</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Created At</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                            <a href="{{ route('products.show', $product->serial_number) }}" target="_blank" title="View"><i class="bi bi-eye-fill rounded bg-green-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-green-600"></i></a>
                                            @if ($product->qr_code)
                                                <a href="{{ route('products.qr_code', $product->serial_number) }}" target="_blank" title="QR Code"><i class="bi bi-qr-code rounded bg-blue-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-blue-600"></i></a>
                                            @endif
                                            <a href="{{ URL::signedRoute('verify_identity_product', $product->serial_number) }}" target="_blank" title="Timeline">
                                                <i class="bi bi-calendar-week-fill rounded bg-cyan-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-cyan-600"></i>
                                            </a>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $product->title }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">Tk {{ number_format($product->price, 2) }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                            <a href="{{ $product->image }}" target="_blank">
                                                <img alt="Product Image" class="w-10" src="{{ $product->image }}">
                                            </a>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $product->serial_number }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $product->warranty_period . ' ' . $product->warranty_period_unit }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $product->created_at->format('Y-m-d | h:i A') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-5 text-center text-red-500" colspan="10">Products empty</td>
                                    </tr>
                                @endforelse
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="10">{{ $products->links('components.pagination-livewire') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
