@if ($paginator->hasPages())
<nav class="flex items-center space-x-2">
    @if ($paginator->onFirstPage())
    <span class="text-gray-500 p-4 inline-flex items-center gap-2 font-medium rounded-md" href="#">
        <span aria-hidden="true">«</span>
        <span class="sr-only">Previous</span>
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}"
        class="text-gray-400 hover:text-blue-600 p-4 inline-flex items-center gap-2 font-medium rounded-md" href="#">
        <span aria-hidden="true">«</span>
        <span class="sr-only">Previous</span>
    </a>
    @endif

    @foreach ($elements as $element)
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <span class="w-10 h-10 bg-blue-500 text-white p-4 inline-flex items-center text-sm font-medium rounded-full"
        aria-current="page">{{ $page }}</span>
    @else
    <a href="{{ $url }}"
        class="w-10 h-10 text-gray-400 hover:text-blue-600 p-4 inline-flex items-center text-sm font-medium rounded-full"
        aria-current="page">{{ $page }}</a>
    @endif
    @endforeach
    @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}"
        class="text-gray-400 hover:text-blue-600 p-4 inline-flex items-center gap-2 font-medium rounded-md" href="#">
        <span class="sr-only">Next</span>
        <span aria-hidden="true">»</span>
    </a>
    @else
    <span class="text-gray-500 p-4 inline-flex items-center gap-2 font-medium rounded-md">
        <span class="sr-only">Next</span>
        <span aria-hidden="true">»</span>
    </span>
    @endif
</nav>
@endif