@push('title', 'Products')

<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Products') }}
            </h2>
            <a class="gap-2 rounded-md border border-transparent bg-gray-500 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" href="{{ route('products.sold') }}" wire:navigate>
                Sold Products
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{
        check_all: @entangle('check_all'),
        checks: @entangle('checks'),
        products: @js($products),
        multiDuplicateModalOpen: @entangle('multi_duplicate_modal_open'),
        multiDuplicateCount: @entangle('multi_duplicate_count'),
        multiDuplicateSerialNumber: @entangle('multi_duplicate_serial_number'),
        triggerMultiDuplicateModal(serial_number) {
            if (serial_number) {
                this.multiDuplicateModalOpen = true;
                this.multiDuplicateSerialNumber = serial_number;
            }
        },
    }" x-init="$watch('check_all', value => checks = value ? products.data.map(product => product.id) : [])" x-on:keydown.escape.window="multiDuplicateModalOpen = false">
        <div class="mx-auto flex max-w-7xl flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="overflow-hidden rounded-lg border dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th colspan="10">
                                        <div class="flex w-full items-start justify-between rounded-t-lg p-5 dark:bg-gray-900">
                                            <div class="flex items-start gap-10">
                                                <div class="text-left">
                                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">List of Products</h2>
                                                    <ul class="ml-4 mt-2 list-disc">
                                                        <li class="text-sm text-gray-400">Total Products: <strong class="text-gray-800 dark:text-white">{{ $products->total() }}</strong></li>
                                                        <li class="text-sm text-gray-400">Sold: <strong class="text-gray-800 dark:text-white">{{ $packages_count - $products_count_left }}</strong></li>
                                                        <li class="text-sm text-gray-400">In Stock: <strong class="text-gray-800 dark:text-white">{{ $products_count_left }}</strong></li>
                                                    </ul>
                                                </div>

                                                <div class="inline-flex gap-3 rounded-md shadow-sm">
                                                    @can('create', \App\Models\Product::class)
                                                        <a class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:bg-green-400 dark:focus:ring-offset-gray-800" href="{{ route('products.create') }}" wire:navigate>
                                                            <i class="bi bi-plus-circle text-base"></i>
                                                            Add Product
                                                        </a>
                                                    @endcan

                                                    @can('sell', \App\Models\Product::class)
                                                        <button class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-blue-500 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:bg-blue-400 dark:focus:ring-offset-gray-800" title="Add to Box" type="button" wire:click="addToBox()" wire:loading.attr="disabled" wire:target="addToBox" x-cloak x-show="checks.length" x-transition>
                                                            <i class="bi bi-bag-plus-fill text-base"></i>
                                                            Add to Box
                                                        </button>
                                                    @endcan
                                                </div>

                                            </div>
                                        </div>
                                    </th>
                                </tr>

                                <tr>
                                    <th class="py-3 pl-4" scope="col">
                                        <div class="flex h-5 items-center">
                                            <input class="cursor-pointer rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800" id="hs-table-checkbox-all" type="checkbox" x-model="check_all">
                                            <label class="sr-only" for="hs-table-checkbox-all">Checkbox</label>
                                        </div>
                                    </th>
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
                                        <td class="py-3 pl-4">
                                            <div class="flex h-5 items-center">
                                                @can('checkable', $product)
                                                    <input class="cursor-pointer rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800" id="hs-table-product-{{ $loop->index + 1 }}" type="checkbox" type="checkbox" value="{{ $product->id }}" x-model="checks">
                                                    <label class="sr-only" for="hs-table-product-{{ $loop->index + 1 }}">Checkbox</label>
                                                @endcan
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                            <a href="{{ route('products.show', $product->serial_number) }}" target="_blank" title="View"><i class="bi bi-eye-fill rounded bg-green-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-green-600"></i></a>
                                            <a href="{{ route('products.edit', $product->serial_number) }}" target="_blank" title="Edit"><i class="bi bi-pen-fill rounded bg-yellow-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-yellow-600"></i></a>
                                            @if ($product->qr_code)
                                                <a href="{{ route('products.qr_code', $product->serial_number) }}" target="_blank" title="QR Code"><i class="bi bi-qr-code rounded bg-blue-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-blue-600"></i></a>
                                            @endif
                                            <a href="{{ URL::signedRoute('verify_identity_product', $product->serial_number) }}" target="_blank" title="Timeline">
                                                <i class="bi bi-calendar-week-fill rounded bg-cyan-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-cyan-600"></i>
                                            </a>
                                            @can('duplicate', $product)
                                                <button title="Duplicate" type="button" x-on:click="confirm('Are you sure you want to duplicate this product?') == true ? $wire.duplicate(@js($product->serial_number)) : null"><i class="bi bi-clipboard-plus-fill rounded bg-orange-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-orange-600"></i></button>
                                                <button title="Duplicate Multiple" type="button" x-on:click="triggerMultiDuplicateModal(@js($product->serial_number))"><i class="bi bi-clipboard-data-fill rounded bg-purple-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-purple-600"></i></button>
                                            @endcan
                                            @can('delete', $product)
                                                <button title="Delete" type="button" x-on:click="confirm('Are you sure you want to delete this product?') == true ? $wire.destroy(@js($product->serial_number)) : null"><i class="bi bi-trash-fill rounded bg-red-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-red-600"></i></button>
                                            @endcan
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

        <div>
            <div class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-cloak x-show="multiDuplicateModalOpen">
                <div class="absolute inset-0 h-full w-full bg-black bg-opacity-40" x-on:click="multiDuplicateModalOpen = false" x-show="multiDuplicateModalOpen" x-transition:enter-end="opacity-100" x-transition:enter-start="opacity-0" x-transition:enter="ease-out duration-300" x-transition:leave-end="opacity-0" x-transition:leave-start="opacity-100" x-transition:leave="ease-in duration-300"></div>
                <div class="relative w-full sm:max-w-lg sm:rounded-lg" x-show="multiDuplicateModalOpen" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter="ease-out duration-300" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-trap.inert.noscroll="multiDuplicateModalOpen">
                    <form class="flex flex-col rounded-xl border bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:shadow-slate-700/[.7]" wire:submit.prevent="duplicateMultiple">
                        <div class="flex items-center justify-between border-b px-4 py-3 dark:border-gray-700">
                            <h3 class="font-bold text-gray-800 dark:text-white">
                                How many duplicates you want for this product?
                            </h3>
                            <button class="hs-dropdown-toggle inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-md text-sm text-gray-500 transition-all hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800" data-hs-overlay="#hs-basic-modal" type="button" x-on:click="multiDuplicateModalOpen = false">
                                <i class="bi bi-x-lg text-lg"></i>
                            </button>
                        </div>
                        <div class="overflow-y-auto p-4">
                            <p class="mt-1 text-gray-800 dark:text-gray-400">
                            <div class="flex rounded-md shadow-sm">
                                <button class="inline-flex flex-shrink-0 items-center justify-center gap-2 rounded-l-md border border-transparent bg-purple-500 px-4 py-0 text-sm font-semibold text-white transition-all hover:bg-purple-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-purple-500" type="button" x-on:click="multiDuplicateCount > 1 ? multiDuplicateCount-- : null">
                                    <i class="bi bi-dash-circle text-lg"></i>
                                    Decrease
                                </button>
                                <input class="block w-full border-y border-purple-500 px-4 py-3 text-sm shadow-sm dark:border-purple-500 dark:bg-slate-900 dark:text-gray-400" max="50" min="1" type="number" x-model="multiDuplicateCount">
                                <button class="inline-flex flex-shrink-0 items-center justify-center gap-2 rounded-r-md border border-transparent bg-purple-500 px-4 py-0 text-sm font-semibold text-white transition-all hover:bg-purple-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-purple-500" type="button" x-on:click="multiDuplicateCount++">
                                    <i class="bi bi-plus-circle text-lg"></i>
                                    Increase
                                </button>
                            </div>
                            </p>
                        </div>
                        <div class="flex items-center justify-end gap-x-2 border-t px-4 py-3 dark:border-gray-700">
                            <button class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-blue-500 px-4 py-3 text-sm font-semibold text-white transition-all hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" href="#" type="submit">
                                Duplicate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
