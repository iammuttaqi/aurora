@if ($paginator->hasPages())
    <nav class="flex items-center justify-center space-x-2">
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center gap-2 rounded-md p-4 font-medium text-gray-500">
                <span aria-hidden="true">«</span>
                <span class="sr-only">Previous</span>
            </span>
        @else
            <button class="inline-flex items-center gap-2 rounded-md p-4 font-medium text-gray-400 hover:text-blue-600" type="button" wire:click="previousPage" wire:loading.attr="disabled">
                <span aria-hidden="true">«</span>
                <span class="sr-only">Previous</span>
            </button>
        @endif

        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="inline-flex h-10 w-10 items-center rounded-full bg-blue-500 p-4 text-sm font-medium text-white">{{ $page }}</span>
                    @else
                        <button aria-current="page" class="inline-flex h-10 w-10 items-center rounded-full p-4 text-sm font-medium text-gray-400 hover:text-blue-600" type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <button class="inline-flex items-center gap-2 rounded-md p-4 font-medium text-gray-400 hover:text-blue-600" type="button" wire:click="nextPage" wire:loading.attr="disabled">
                <span class="sr-only">Next</span>
                <span aria-hidden="true">»</span>
            </button>
        @else
            <span class="inline-flex items-center gap-2 rounded-md p-4 font-medium text-gray-500">
                <span class="sr-only">Next</span>
                <span aria-hidden="true">»</span>
            </span>
        @endif
    </nav>
@endif
