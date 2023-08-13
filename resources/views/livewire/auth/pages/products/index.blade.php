@push('title', 'Products')

@push('cdn')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endpush

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12" class="relative z-50 h-auto w-auto" x-data="{
        check_all: @entangle('check_all').defer,
        checks: @entangle('checks').defer,
        products: @js($products),
        multiDuplicateModalOpen: @entangle('multi_duplicate_modal_open').defer,
        multiDuplicateCount: @entangle('multi_duplicate_count').defer,
        multiDuplicateSerialNumber: @entangle('multi_duplicate_serial_number').defer,
        triggerMultiDuplicateModal(serial_number) {
            if (serial_number) {
                this.multiDuplicateModalOpen = true;
                this.multiDuplicateSerialNumber = serial_number;
            }
        },
        sell_modal: @entangle('sell_modal').defer,
        sellModalOpen() {
            this.sell_modal = true;
        }
    }" x-init="$watch('check_all', value => checks = value ? products.data.map(product => product.id) : [])" x-on:keydown.escape.window="multiDuplicateModalOpen = false">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <div class="flex flex-col">

                    <div class="-m-1.5 overflow-x-auto">
                        <div class="inline-block min-w-full p-1.5 align-middle">
                            <div class="divide-y divide-gray-200 rounded-lg border dark:divide-gray-700 dark:border-gray-700">
                                <div class="flex items-center justify-between gap-10 px-4 py-3">
                                    <div class="flex items-center gap-5">
                                        <h2 class="my-2 text-xl font-semibold text-gray-800 dark:text-gray-200">
                                            List of Products
                                        </h2>
                                        @can('sell', \App\Models\Product::class)
                                            <button class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-blue-500 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" title="Add to Box" type="button" wire:click="addToBox()" x-cloak x-show="checks.length" x-transition>
                                                <i class="bi bi-bag-plus-fill text-base"></i>
                                                Add to Box
                                            </button>
                                        @endcan
                                    </div>

                                    @can('create', \App\Models\Product::class)
                                        <div class="inline-flex gap-3 rounded-md shadow-sm">
                                            <a class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" href="{{ route('products.create') }}">
                                                Add Product
                                            </a>
                                        </div>
                                    @endcan
                                </div>

                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th class="px-4 py-3 pr-0" scope="col">
                                                    <div class="flex h-5 items-center">
                                                        <input class="cursor-pointer rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800" id="hs-table-pagination-checkbox-all" type="checkbox" x-model="check_all">
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
                                                        @if ($product->checkable)
                                                            <div class="flex h-5 items-center">
                                                                <input class="cursor-pointer rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800" id="hs-table-pagination-checkbox-{{ $loop->index + 1 }}" type="checkbox" value="{{ $product->id }}" x-model="checks">
                                                                <label class="sr-only" for="hs-table-pagination-checkbox-{{ $loop->index + 1 }}">Checkbox</label>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-left text-sm font-medium" x-data>
                                                        <a href="{{ route('products.show', $product->serial_number) }}" target="_blank"><i class="bi bi-eye-fill rounded bg-green-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-green-600"></i></a>
                                                        @if ($product->qr_code)
                                                            <a href="{{ route('products.qr_code', $product->serial_number) }}" target="_blank"><i class="bi bi-qr-code rounded bg-blue-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-blue-600"></i></a>
                                                        @endif
                                                        @can('duplicateProducts', auth()->user())
                                                            <button title="Duplicate" type="button" x-on:click="confirm('Are you sure you want to duplicate this product?') == true ? $wire.duplicate(@js($product->serial_number)) : null"><i class="bi bi-clipboard-plus-fill rounded bg-yellow-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-yellow-600"></i></button>
                                                            <button title="Duplicate Multiple" type="button" x-on:click="triggerMultiDuplicateModal(@js($product->serial_number))"><i class="bi bi-clipboard-data-fill rounded bg-purple-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-purple-600"></i></button>
                                                        @endcan
                                                        <button title="Delete" type="button" x-on:click="confirm('Are you sure you want to delete this product?') == true ? $wire.destroy(@js($product->serial_number)) : null"><i class="bi bi-trash-fill rounded bg-red-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-red-600"></i></button>
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

                <div>
                    <div class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-cloak x-show="multiDuplicateModalOpen">
                        <div @click="multiDuplicateModalOpen = false" class="absolute inset-0 h-full w-full bg-black bg-opacity-40" x-show="multiDuplicateModalOpen" x-transition:enter-end="opacity-100" x-transition:enter-start="opacity-0" x-transition:enter="ease-out duration-300" x-transition:leave-end="opacity-0" x-transition:leave-start="opacity-100" x-transition:leave="ease-in duration-300"></div>
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
                                        <input class="block w-full rounded-l-md border-gray-200 px-4 py-3 text-sm shadow-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-slate-900 dark:text-gray-400" id="hs-trailing-button-add-on" min="1" name="hs-trailing-button-add-on" type="number" x-model="multiDuplicateCount">
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
    </div>
</div>

@push('scripts')
    <script>
        new TomSelect('.shop_id', {
            placeholder: 'Select...',
            plugins: {
                remove_button: {
                    title: 'Remove this item',
                }
            },
        });
    </script>
@endpush
