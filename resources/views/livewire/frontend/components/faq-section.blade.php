<section class="mx-auto max-w-[85rem] bg-gray-50 px-4 py-10 sm:px-6 lg:px-8 lg:py-14" id="faq">
    <!-- Title -->
    <div class="mx-auto mb-10 max-w-2xl text-center lg:mb-14">
        <h2 class="text-2xl font-bold text-gray-800 md:text-3xl md:leading-tight">Frequently Asked Questions</h2>
        <p class="mt-1 text-gray-600">Answers to Your Most Common Questions</p>
    </div>
    <!-- End Title -->

    <div class="mx-auto max-w-5xl">
        <!-- Grid -->
        <div class="grid gap-6 sm:grid-cols-2 md:gap-12">
            @foreach ($faqs as $faq)
                <div class="rounded-lg bg-white p-5 shadow">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $faq['title'] }}
                    </h3>
                    <p class="mt-2 text-gray-600">
                        {{ $faq['details'] }}
                    </p>
                </div>
            @endforeach
        </div>
        <!-- End Grid -->
    </div>
</section>
