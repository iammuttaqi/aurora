@push('title', $product->title)

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $product->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <ul class="flex max-w-full flex-col">
                    <li class="-mt-px inline-flex items-center gap-x-2 border bg-white px-4 py-3 text-sm font-medium text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <div class="flex w-full justify-between">
                            Title
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium text-white">{{ $product->title }}</span>
                        </div>
                    </li>
                    <li class="-mt-px inline-flex items-center gap-x-2 border bg-white px-4 py-3 text-sm font-medium text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <div class="flex w-full justify-between">
                            Manufacturer
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium text-white">{{ $product->manufacturer->name }}</span>
                        </div>
                    </li>
                    <li class="-mt-px inline-flex items-center gap-x-2 border bg-white px-4 py-3 text-sm font-medium text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <div class="flex w-full justify-between">
                            Category
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium text-white">{{ $product->product_category->title }}</span>
                        </div>
                    </li>
                    <li class="-mt-px inline-flex items-center gap-x-2 border bg-white px-4 py-3 text-sm font-medium text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <div class="flex w-full justify-between">
                            Description
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium text-white">{{ $product->description }}</span>
                        </div>
                    </li>
                    <li class="-mt-px inline-flex items-center gap-x-2 border bg-white px-4 py-3 text-sm font-medium text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <div class="flex w-full justify-between">
                            Price
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium text-white">Tk {{ number_format($product->price, 2) }}</span>
                        </div>
                    </li>
                    <li class="-mt-px inline-flex items-center gap-x-2 border bg-white px-4 py-3 text-sm font-medium text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <div class="flex w-full justify-between">
                            Warranty
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium text-white">{{ $product->warranty_period . ' ' . $product->warranty_period_unit }}</span>
                        </div>
                    </li>
                    <li class="-mt-px inline-flex items-center gap-x-2 border bg-white px-4 py-3 text-sm font-medium text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        <div class="flex w-full justify-between">
                            QR Code
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium text-white">
                                {!! $product->qr_code !!}
                            </span>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
