@if ($paginator->hasPages())
    <nav class="flex items-center space-x-2">
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center gap-2 rounded-md p-4 font-medium text-gray-500" href="#">
                <span aria-hidden="true">«</span>
                <span class="sr-only">Previous</span>
            </span>
        @else
            <a class="inline-flex items-center gap-2 rounded-md p-4 font-medium text-gray-400 hover:text-blue-600" href="{{ $paginator->previousPageUrl() }}" href="#">
                <span aria-hidden="true">«</span>
                <span class="sr-only">Previous</span>
            </a>
        @endif

        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="inline-flex h-10 w-10 items-center rounded-full bg-blue-500 p-4 text-sm font-medium text-white">{{ $page }}</span>
                    @else
                        <a aria-current="page" class="inline-flex h-10 w-10 items-center rounded-full p-4 text-sm font-medium text-gray-400 hover:text-blue-600" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a class="inline-flex items-center gap-2 rounded-md p-4 font-medium text-gray-400 hover:text-blue-600" href="{{ $paginator->nextPageUrl() }}" href="#">
                <span class="sr-only">Next</span>
                <span aria-hidden="true">»</span>
            </a>
        @else
            <span class="inline-flex items-center gap-2 rounded-md p-4 font-medium text-gray-500">
                <span class="sr-only">Next</span>
                <span aria-hidden="true">»</span>
            </span>
        @endif
    </nav>
@endif
