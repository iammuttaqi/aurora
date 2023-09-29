<section class="mx-auto max-w-[85rem] bg-gray-50 px-4 py-10 sm:px-6 lg:px-8 lg:py-14" id="clients">
    <!-- Title -->
    <div class="mx-auto mb-6 text-center sm:w-1/2 md:mb-12 xl:w-1/3">
        <h2 class="text-xl font-semibold text-gray-800 md:text-2xl md:leading-tight">Trusted by Industry Leaders and Over 1000 Satisfied Users</h2>
    </div>
    <!-- End Title -->

    <!-- Grid -->
    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-5 lg:gap-6">
        @foreach ($testimonials as $testimonial)
            <div class="rounded-lg bg-gray-100 p-4 md:p-7">
                <img class="mx-auto h-[100px] object-contain py-3 lg:py-5" src="{{ $testimonial['logo'] }}">
            </div>
        @endforeach
    </div>
    <!-- End Grid -->
</section>
