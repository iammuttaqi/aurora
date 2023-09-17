<section class="mx-auto max-w-[85rem] bg-gray-50 px-4 py-10 sm:px-6 lg:px-8 lg:py-14" id="features">
    <!-- Title -->
    <div class="mx-auto mb-10 max-w-2xl text-center lg:mb-14">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight">Features</h2>
        <p class="mt-1 text-gray-600">Our Comprehensive Features to Serve You Better.</p>
    </div>
    <!-- End Title -->

    <div class="grid items-center gap-6 sm:grid-cols-2 md:gap-10 lg:grid-cols-3">
        @foreach ($features as $feature)
            <!-- Card -->
            <div class="h-full w-full rounded-lg border-2 border-transparent bg-white p-5 shadow-lg transition-all hover:border-blue-500 dark:bg-slate-900">
                <div class="mb-3 flex items-center gap-x-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-md bg-gradient-to-br from-blue-600 to-violet-600">
                        <i class="bi {{ $feature['icon'] }} text-2xl text-white"></i>
                    </div>
                    <!-- End Icon -->
                    <div class="flex-shrink-0">
                        <h3 class="block text-lg font-semibold text-gray-800 dark:text-white">{{ $feature['title'] }}</h3>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-400">{{ $feature['details'] }}</p>
            </div>
            <!-- End Card -->
        @endforeach
    </div>
</section>
