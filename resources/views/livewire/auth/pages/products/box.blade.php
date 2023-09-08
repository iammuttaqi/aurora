@push('title', 'Product Box')

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
                        <div class="mb-5 flex justify-between">
                            <h2 class="text-xl text-gray-900 dark:text-white">List of Products to Sell</h2>
                            @if (count($products))
                                <button class="relative !block items-center justify-center gap-2 rounded-md border border-none border-transparent bg-red-500 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:text-white hover:dark:text-white dark:focus:ring-offset-gray-800" wire:click="removeAll" wire:loading.attr="disabled" wire:loading.class="!bg-red-400" wire:target="removeAll">
                                    <i class="bi bi-trash-fill text-base"></i>
                                    <span>Remove All</span>
                                </button>
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <div class="-m-1.5 overflow-x-auto">
                                <div class="inline-block min-w-full align-middle">
                                    <div class="overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                @forelse ($products as $product)
                                                    <tr>
                                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{!! $product->title_wrapped !!}</td>
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
                        <div class="col-span-1 flex flex-col gap-5" x-data="{
                            buyer_types: @js($buyer_types),
                            buyer_type_default: @js($buyer_type_default),
                        }">
                            @can('canSellToBoth', \App\Models\Product::class)
                                <div class="grid gap-2 sm:grid-cols-2">
                                    <template :key="buyer_type.title" x-for="buyer_type in buyer_types">
                                        <label class="flex w-full cursor-pointer rounded-md border border-gray-200 bg-white p-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-slate-900 dark:text-gray-400" x-bind:for="'buyer-type-' + buyer_type.slug">
                                            <input class="pointer-events-none mt-0.5 shrink-0 rounded-full border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800" name="buyer_type" type="radio" x-bind:value="buyer_type.slug" x-bind:id="'buyer-type-' + buyer_type.slug" x-bind:checked="buyer_type.slug == 'customer'" x-model="buyer_type_default">
                                            <span class="ml-3 text-sm text-gray-500 dark:text-gray-400" x-text="buyer_type.title"></span>
                                        </label>
                                    </template>
                                </div>
                            @endcan

                            @can('canSellToBoth', \App\Models\Product::class)
                                <div class="flex flex-col gap-3 rounded bg-gray-100/100 p-5 dark:bg-gray-700/50" x-show="buyer_type_default == 'customer'" x-transition>
                                    <h2 class="text-xl text-gray-900 dark:text-white">Add Customer to Sell</h2>
                                    <livewire:auth.components.customer-form />
                                </div>
                            @endcan

                            <div class="flex flex-col gap-3 rounded bg-gray-100/100 p-5 dark:bg-gray-700/50" x-show="buyer_type_default == 'shop'" x-transition>
                                <h2 class="text-xl text-gray-900 dark:text-white">Select Shop to Sell</h2>
                                <livewire:auth.components.shop-select-form />
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        if (typeof tom_select === 'undefined') {
            const tom_select = new TomSelect('.shop_id', {
                placeholder: 'Select...',
                plugins: {
                    remove_button: {
                        title: 'Remove this item',
                    }
                },
                maxOptions: 1000
            });
        }
    </script>
@endpush
