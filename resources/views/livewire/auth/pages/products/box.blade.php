@push('title', 'Product Box')

@push('cdn')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endpush

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Product Box') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <div class="mb-48 grid grid-cols-3 gap-5 p-5">
                    <div class="col-span-2">
                        <h2 class="mb-5 text-xl text-white">List of Products to Sell</h2>
                        <div class="flex flex-col">
                            <div class="-m-1.5 overflow-x-auto">
                                <div class="inline-block min-w-full p-1.5 align-middle">
                                    <div class="overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                @forelse ($products as $product)
                                                    <tr>
                                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $product->title }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $product->serial_number }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">Tk {{ number_format($product->price, 2) }}</td>
                                                        <td>
                                                            <button title="Remove" type="button" wire:loading.attr="disabled" wire:target="addToBox" x-on:click="confirm('Are you sure you want to remove this product from product box?') == true ? $wire.remove(@js($product->id)) : null"><i class="bi bi-trash-fill rounded bg-red-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-red-600"></i></button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="whitespace-nowrap bg-red-600/50 px-6 py-4 text-center text-sm text-white" colspan="10">No products found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (count($products))
                        <div class="col-span-1 rounded bg-gray-700/50 p-5">
                            <h2 class="mb-5 text-xl text-white">Select Shop to Sell</h2>
                            <form wire:submit.prevent="sell">
                                <div class="grid gap-y-4">
                                    <div class="flex flex-col gap-1" wire:ignore>
                                        <select class="shop_id" name="shop_id" required wire:model.defer="shop_id">
                                            <option value="">Select</option>
                                            @foreach ($shops as $shop)
                                                <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error for="shop_id" />
                                    </div>

                                    <button class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-blue-500 px-4 py-3 text-sm font-semibold text-white transition-all hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" type="submit" wire:loading.class="!bg-blue-400" wire:target="sell">
                                        <span aria-label="loading" class="inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-white" role="status" wire:loading wire:target="sell"></span>
                                        Sell to the Selected Shop
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
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
            maxOptions: 1000
        });
    </script>
@endpush
