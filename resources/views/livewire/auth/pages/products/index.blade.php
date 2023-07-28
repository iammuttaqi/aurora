@push('title', 'Products')

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <div class="flex flex-col">

                    <div class="-m-1.5 overflow-x-auto">
                        <div class="inline-block min-w-full p-1.5 align-middle">
                            <div class="divide-y divide-gray-200 rounded-lg border dark:divide-gray-700 dark:border-gray-700">
                                <div class="flex items-center justify-start gap-10 px-4 py-3">
                                    <h2 class="py-3 text-xl font-semibold text-gray-800 dark:text-gray-200">
                                        Products
                                    </h2>

                                    <div class="inline-flex gap-3 rounded-md shadow-sm">
                                        <a class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" href="{{ route('products.create') }}">
                                            Add Product
                                        </a>
                                    </div>
                                </div>

                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th class="px-4 py-3 pr-0" scope="col">
                                                    <div class="flex h-5 items-center">
                                                        <input class="cursor-pointer rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800" id="hs-table-pagination-checkbox-all" type="checkbox">
                                                        <label class="sr-only" for="hs-table-pagination-checkbox-all">Checkbox</label>
                                                    </div>
                                                </th>
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
                                            @forelse ($products as $product)
                                                <tr>
                                                    <td class="py-3 pl-4">
                                                        <div class="flex h-5 items-center">
                                                            <input class="cursor-pointer rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800" id="hs-table-pagination-checkbox-{{ $loop->index + 1 }}" type="checkbox" value="{{ $product->id }}" x-model="checks">
                                                            <label class="sr-only" for="hs-table-pagination-checkbox-{{ $loop->index + 1 }}">Checkbox</label>
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium" x-data>
                                                        <a href="{{ route('products.show', $product->serial_number) }}" target="_blank"><i class="bi bi-eye-fill rounded bg-green-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-green-600"></i></a>
                                                        @if ($product->qr_code)
                                                            <a href="{{ route('products.qr_code', $product->serial_number) }}" target="_blank"><i class="bi bi-qr-code rounded bg-blue-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-blue-600"></i></a>
                                                        @endif
                                                        <button type="button" x-on:click="confirm('Are you sure you want to duplicate this product?') == true ? $wire.duplicate(@js($product->serial_number)) : null"><i class="bi bi-clipboard-plus-fill rounded bg-yellow-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-yellow-600"></i></button>
                                                        <button type="button" x-on:click="confirm('Are you sure?') == true ? $wire.destroy(@js($product->serial_number)) : null"><i class="bi bi-trash-fill rounded bg-red-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-red-600"></i></button>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $product->title }}</td>
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
                                    {{ $products->links('components.pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
