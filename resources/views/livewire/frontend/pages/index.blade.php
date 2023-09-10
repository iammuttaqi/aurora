@push('title', config('app.name'))

<div>
    <!-- Hero -->
    <section class="relative overflow-hidden bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200 before:absolute before:left-1/2 before:top-0 before:-z-[1] before:h-full before:w-full before:-translate-x-1/2 before:transform before:bg-[url('../svg/component/polygon.svg')] before:bg-cover before:bg-top before:bg-no-repeat">
        <div class="mx-auto max-w-[85rem] px-4 py-[10rem] sm:px-6 lg:px-8">
            <!-- Announcement Banner -->
            <div class="flex justify-center">
                <a class="inline-flex items-center gap-x-2 rounded-full border border-gray-200 bg-white p-1 pl-3 text-sm text-gray-800 transition hover:border-gray-300" href="#">
                    Beta Release - Join to waitlist
                    <span class="inline-flex items-center justify-center gap-x-2 rounded-full bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-600">
                        <svg class="h-2.5 w-2.5" fill="none" height="16" viewBox="0 0 16 16" width="16">
                            <path d="M5.27921 2L10.9257 7.64645C11.1209 7.84171 11.1209 8.15829 10.9257 8.35355L5.27921 14" stroke-linecap="round" stroke-width="2" stroke="currentColor" />
                        </svg>
                    </span>
                </a>
            </div>
            <!-- End Announcement Banner -->

            <!-- Title -->
            <div class="mx-auto mt-5 max-w-5xl text-center">
                <h1 class="block text-4xl font-bold text-gray-800 md:text-5xl lg:text-6xl">
                    Managing
                    <span class="bg-gradient-to-tl from-blue-600 to-violet-600 bg-clip-text text-transparent">Products</span>
                    Made Simple
                </h1>
            </div>
            <!-- End Title -->

            <div class="mx-auto mt-5 max-w-3xl text-center">
                <p class="text-lg text-gray-600">Empowering Manufacturers, Shops, and Customers to Seamlessly Track Product Ownership and Warranty Information. Join Us in Creating a Transparent and Trustworthy Marketplace.</p>
            </div>

            <!-- Buttons -->
            <div class="mt-8 grid w-full gap-3 sm:inline-flex sm:justify-center">
                <a class="inline-flex items-center justify-center gap-x-3 rounded-md border border-transparent bg-gradient-to-tl from-blue-600 to-violet-600 px-4 py-3 text-center text-sm font-medium text-white hover:from-violet-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white" href="{{ route('register') }}" wire:navigate.hover>
                    Get started
                    <svg class="h-3 w-3" fill="none" height="16" viewBox="0 0 16 16" width="16">
                        <path d="M5.27921 2L10.9257 7.64645C11.1209 7.84171 11.1209 8.15829 10.9257 8.35355L5.27921 14" stroke-linecap="round" stroke-width="2" stroke="currentColor" />
                    </svg>
                </a>
                <a class="group relative inline-flex items-center justify-center gap-x-3.5 rounded-md border bg-white px-4 py-3 text-center text-sm font-medium shadow-sm transition hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-800 dark:bg-slate-900 dark:text-white dark:shadow-slate-700/[.7] dark:hover:border-gray-600 dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate.hover>
                    Login
                </a>
            </div>
            <!-- End Buttons -->
        </div>
    </section>
    <!-- End Hero -->

    <!-- Icon Blocks -->
    <div class="mx-auto max-w-[85rem] bg-gray-50 px-4 py-10 sm:px-6 lg:px-8 lg:py-14" id="services">
        <div class="grid items-center gap-6 sm:grid-cols-2 md:gap-10 lg:grid-cols-3">
            @foreach ($services as $service)
                <!-- Card -->
                <div class="h-full w-full rounded-lg border-2 border-transparent bg-white p-5 shadow-lg transition-all hover:border-blue-500 dark:bg-slate-900">
                    <div class="mb-3 flex items-center gap-x-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-md bg-gradient-to-br from-blue-600 to-violet-600">
                            <i class="bi {{ $service['icon'] }} text-2xl text-white"></i>
                        </div>
                        <!-- End Icon -->
                        <div class="flex-shrink-0">
                            <h3 class="block text-lg font-semibold text-gray-800 dark:text-white">{{ $service['title'] }}</h3>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">{{ $service['details'] }}</p>
                </div>
                <!-- End Card -->
            @endforeach
        </div>
    </div>
    <!-- End Icon Blocks -->

    <!-- Pricing -->
    <section class="mx-auto max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14" id="pricing">
        <!-- Title -->
        <div class="mx-auto mb-10 max-w-2xl text-center lg:mb-14">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight">Pricing</h2>
            <p class="mt-1 text-gray-600">Whatever your status, our offers evolve according to your needs.</p>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4 lg:items-center">
            @foreach ($pricings as $pricing)
                <!-- Card -->
                <div class="{{ $pricing['popular'] ? 'border-blue-600 border-2' : 'border-gray-200 border' }} flex flex-col rounded-xl p-8 text-center">
                    @if ($pricing['popular'])
                        <p class="mb-3"><span class="inline-flex items-center gap-1.5 rounded-md bg-blue-100 px-3 py-1.5 text-xs font-semibold uppercase text-blue-800">Most popular</span></p>
                    @endif

                    <h4 class="text-lg font-medium text-gray-800">{{ $pricing['label'] }}</h4>
                    <span class="mt-7 text-5xl font-bold text-gray-800">{{ $pricing['title'] }}</span>
                    <p class="mt-2 text-sm text-gray-500">{{ $pricing['sub_title'] }}</p>

                    <ul class="mt-7 space-y-2.5 text-sm">
                        @foreach ($pricing['features'] as $feature)
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

                    <a class="mt-5 inline-flex items-center justify-center gap-2 rounded-md border-2 border-blue-600 px-4 py-3 text-sm font-semibold text-blue-600 transition-all hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" href="#">
                        Purchase Plan
                    </a>
                </div>
                <!-- End Card -->
            @endforeach
        </div>
        <!-- End Grid -->

    </section>
    <!-- End Pricing -->

    <!-- FAQ -->
    <section class="mx-auto max-w-[85rem] bg-gray-50 px-4 py-10 sm:px-6 lg:px-8 lg:py-14" id="faq">
        <!-- Title -->
        <div class="mx-auto mb-10 max-w-2xl text-center lg:mb-14">
            <h2 class="text-2xl font-bold text-gray-800 md:text-3xl md:leading-tight">
                Frequently Asked Questions
            </h2>
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
    <!-- End FAQ -->

    <!-- Testimonials -->
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

    <!-- Features -->
    <section class="mx-auto max-w-[85rem] bg-gray-50 px-4 py-10 sm:px-6 lg:px-8 lg:py-14" id="features">
        <!-- Grid -->
        <div class="grid items-center gap-6 lg:grid-cols-12 lg:gap-12">
            <div class="lg:col-span-4">
                <!-- Stats -->
                <div class="lg:pr-6 xl:pr-12">
                    <p class="text-6xl font-bold leading-10 text-blue-500">
                        1,000+
                    </p>
                    <p class="mt-2 text-gray-500 sm:mt-3">Partnership Established</p>
                </div>
                <!-- End Stats -->
            </div>
            <!-- End Col -->

            <div class="relative lg:col-span-8 lg:before:absolute lg:before:-left-12 lg:before:top-0 lg:before:h-full lg:before:w-px lg:before:bg-gray-200">
                <div class="grid grid-cols-2 gap-6 sm:gap-8 md:grid-cols-4 lg:grid-cols-3">
                    <!-- Stats -->
                    <div>
                        <p class="text-3xl font-semibold text-blue-500">2,00,000+</p>
                        <p class="mt-1 text-gray-500">Products Verified</p>
                    </div>
                    <!-- End Stats -->

                    <!-- Stats -->
                    <div>
                        <p class="text-3xl font-semibold text-blue-500">2,20,000+</p>
                        <p class="mt-1 text-gray-500">Satisfied Customers</p>
                    </div>
                    <!-- End Stats -->

                    <!-- Stats -->
                    <div>
                        <p class="text-3xl font-semibold text-blue-500">150+</p>
                        <p class="mt-1 text-gray-500">Countries Served</p>
                    </div>
                    <!-- End Stats -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Grid -->
    </section>
    <!-- End Features -->

    <!-- Announcement Banner -->
    <section class="bg-gradient-to-r from-red-500 via-purple-400 to-blue-500">
        <div class="mx-auto max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8">
            <!-- Grid -->
            <div class="grid justify-center gap-2 md:grid-cols-2 md:items-center md:justify-between">
                <div class="text-center md:text-left">
                    <p class="mt-1 font-medium text-white">
                        Join us today to experience a new era of trust in every purchase.
                    </p>
                </div>
                <!-- End Col -->

                <div class="text-center md:flex md:items-center md:justify-end md:text-left">
                    <a class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-3 align-middle text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white" href="{{ route('register') }}" wire:navigate.hover>
                        Sign up free
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Grid -->
        </div>
    </section>
    <!-- End Announcement Banner -->

    <!-- Clients -->
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
                    <img class="mx-auto h-[100px] object-contain py-3 lg:py-5" src="{{ asset($testimonial['logo']) }}">
                </div>
            @endforeach
        </div>
        <!-- End Grid -->
    </section>
    <!-- End Clients -->
</div>
