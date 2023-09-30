<div class="{{ $package->popular ? 'border-blue-600 border-2' : 'border-gray-300 border' }} flex flex-col rounded-xl bg-white p-8 text-center">
    @if ($package->popular)
        <p class="mb-3"><span class="inline-flex items-center gap-1.5 rounded-md bg-blue-100 px-3 py-1.5 text-xs font-semibold uppercase text-blue-800">Most popular</span></p>
    @endif

    <h4 class="text-lg font-medium text-gray-800">{{ $package->title }}</h4>
    <span class="mt-7 text-4xl font-bold text-gray-800">Tk. {{ number_format($package->price, 2) }}</span>
    <p class="mt-2 text-sm text-gray-500">{{ $package->details }}</p>

    <ul class="mt-7 space-y-2.5 text-sm">
        @foreach ($package->features as $feature)
            <li class="flex space-x-2">
                @if ($feature['active'])
                    <i class="bi bi-check-lg flex-shrink-0 text-green-600"></i>
                @else
                    <i class="bi bi-x-lg flex-shrink-0 text-red-600"></i>
                @endif
                <span class="text-gray-800">
                    {{ $feature['title'] }}
                </span>
            </li>
        @endforeach
    </ul>

    @if ($purchaseable)
        @if ($package->price > 0)
            <form wire:submit="purchase('{{ $package->id }}')">
                <button class="mt-5 inline-flex items-center justify-center gap-2 rounded-md border-2 border-blue-600 px-4 py-3 text-sm font-semibold text-blue-600 transition-all hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" type="submit">
                    Purchase Plan
                </button>
            </form>
        @else
            <span class="mt-5 inline-flex cursor-not-allowed items-center justify-center gap-2 rounded-md border-2 border-gray-600 px-4 py-3 text-sm font-semibold text-gray-400 transition-all">
                Purchase Plan
            </span>
        @endif
    @endif
</div>
