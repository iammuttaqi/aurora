<section class="mx-auto max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14" id="pricing">
    <div class="mx-auto mb-10 max-w-2xl text-center lg:mb-14">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight">Pricing</h2>
        <p class="mt-1 text-gray-600">Whatever your status, our offers evolve according to your needs.</p>
    </div>

    <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4 lg:items-center">
        @foreach ($packages as $package)
            <div class="{{ $package->popular ? 'border-blue-600 border-2' : 'border-gray-200 border' }} flex flex-col rounded-xl p-8 text-center">
                @if ($package->popular)
                    <p class="mb-3"><span class="inline-flex items-center gap-1.5 rounded-md bg-blue-100 px-3 py-1.5 text-xs font-semibold uppercase text-blue-800">Most popular</span></p>
                @endif

                <h4 class="text-lg font-medium text-gray-800">{{ $package->label }}</h4>
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

                @if ($package->price > 0)
                    <a class="mt-5 inline-flex items-center justify-center gap-2 rounded-md border-2 border-blue-600 px-4 py-3 text-sm font-semibold text-blue-600 transition-all hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" href="#">
                        Purchase Plan
                    </a>
                @else
                    <span class="mt-5 inline-flex cursor-not-allowed items-center justify-center gap-2 rounded-md border-2 border-gray-600 px-4 py-3 text-sm font-semibold text-gray-400 transition-all">
                        Purchase Plan
                    </span>
                @endif
            </div>
        @endforeach
    </div>

</section>
