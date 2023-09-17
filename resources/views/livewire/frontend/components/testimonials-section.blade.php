<section class="mx-auto max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14" id="testimonials">
    <!-- Title -->
    <div class="mx-auto mb-10 max-w-2xl text-center lg:mb-14">
        <h2 class="text-2xl font-bold text-gray-800 md:text-3xl md:leading-tight">
            Testimonials
        </h2>
    </div>
    <!-- End Title -->

    <!-- Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($testimonials as $testimonial)
            <!-- Card -->
            <div class="flex flex-col rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="flex-auto p-4 md:p-6">
                    <img alt="{{ $testimonial['title'] }}" class="h-10" src="{{ asset($testimonial['logo']) }}">
                    <p class="mt-3 text-base text-gray-800 sm:mt-6 md:text-xl"><em>
                            " {{ $testimonial['details'] }} "
                        </em></p>
                </div>

                <div class="rounded-b-xl p-4 md:px-6">
                    <h3 class="text-sm font-semibold text-gray-800 sm:text-base">
                        {{ $testimonial['title'] }}
                    </h3>
                    {{-- <p class="text-sm text-gray-500">
                    Director Payments & Risk | HubSpot
                </p> --}}
                </div>
            </div>
            <!-- End Card -->
        @endforeach
    </div>
    <!-- End Grid -->
</section>
<!-- End Testimonials -->
