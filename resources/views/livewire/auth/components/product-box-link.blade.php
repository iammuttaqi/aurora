<div>
    @if ($product_box)
        <x-nav-link class="relative !block items-center justify-center gap-2 rounded-md border border-none border-transparent bg-blue-500 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-white hover:dark:text-white dark:focus:ring-offset-gray-800" href="{{ route('products.box') }}">
            <i class="bi bi-bag-fill text-xl"></i>
            <span>Product Box</span>
        </x-nav-link>
    @endif
</div>
