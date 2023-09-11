@push('title', config('app.name'))

<div>
    <!-- Hero -->
    <section class="relative overflow-hidden bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200 transition-all before:absolute before:left-1/2 before:top-0 before:-z-[1] before:h-full before:w-full before:-translate-x-1/2 before:transform before:bg-cover before:bg-top before:bg-no-repeat" id="hero">
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

        <div aria-hidden="true" class="absolute -left-24 top-2/4 hidden -translate-x-40 -translate-y-2/4 transform animate-bounce md:block lg:-translate-x-80">
            <svg class="h-auto w-52" fill="none" height="653" viewBox="0 0 717 653" width="717" xmlns="http://www.w3.org/2000/svg">
                <path class="fill-gray-800 dark:fill-white" d="M170.176 228.357C177.176 230.924 184.932 227.329 187.498 220.329C190.064 213.329 186.47 205.574 179.47 203.007L170.176 228.357ZM98.6819 71.4156L85.9724 66.8638L85.8472 67.2136L85.7413 67.5698L98.6819 71.4156ZM336.169 77.9736L328.106 88.801L328.288 88.9365L328.475 89.0659L336.169 77.9736ZM616.192 128.685C620.658 122.715 619.439 114.254 613.469 109.788L516.183 37.0035C510.213 32.5371 501.753 33.756 497.286 39.726C492.82 45.696 494.039 54.1563 500.009 58.6227L586.485 123.32L521.788 209.797C517.322 215.767 518.541 224.227 524.511 228.694C530.481 233.16 538.941 231.941 543.407 225.971L616.192 128.685ZM174.823 215.682C179.47 203.007 179.475 203.009 179.48 203.011C179.482 203.012 179.486 203.013 179.489 203.014C179.493 203.016 179.496 203.017 179.498 203.018C179.501 203.019 179.498 203.018 179.488 203.014C179.469 203.007 179.425 202.99 179.357 202.964C179.222 202.912 178.991 202.822 178.673 202.694C178.035 202.437 177.047 202.026 175.768 201.456C173.206 200.314 169.498 198.543 165.106 196.099C156.27 191.182 144.942 183.693 134.609 173.352C114.397 153.124 97.7311 122.004 111.623 75.2614L85.7413 67.5698C68.4512 125.748 89.856 166.762 115.51 192.436C128.11 205.047 141.663 213.953 151.976 219.692C157.158 222.575 161.591 224.698 164.777 226.118C166.371 226.828 167.659 227.365 168.578 227.736C169.038 227.921 169.406 228.065 169.675 228.168C169.809 228.22 169.919 228.261 170.002 228.293C170.044 228.309 170.08 228.322 170.109 228.333C170.123 228.338 170.136 228.343 170.147 228.347C170.153 228.349 170.16 228.352 170.163 228.353C170.17 228.355 170.176 228.357 174.823 215.682ZM111.391 75.9674C118.596 55.8511 137.372 33.9214 170.517 28.6833C204.135 23.3705 255.531 34.7533 328.106 88.801L344.233 67.1462C268.876 11.0269 210.14 -4.91361 166.303 2.01428C121.993 9.01681 95.9904 38.8917 85.9724 66.8638L111.391 75.9674ZM328.475 89.0659C398.364 137.549 474.018 153.163 607.307 133.96L603.457 107.236C474.34 125.837 406.316 110.204 343.864 66.8813L328.475 89.0659Z" fill="currentColor"></path>
                <path class="fill-orange-500" d="M17.863 238.22C10.4785 237.191 3.6581 242.344 2.62917 249.728C1.60024 257.113 6.75246 263.933 14.137 264.962L17.863 238.22ZM117.548 265.74L119.421 252.371L119.411 252.37L117.548 265.74ZM120.011 466.653L132.605 471.516L132.747 471.147L132.868 470.771L120.011 466.653ZM285.991 553.767C291.813 549.109 292.756 540.613 288.098 534.792L212.193 439.92C207.536 434.098 199.04 433.154 193.218 437.812C187.396 442.47 186.453 450.965 191.111 456.787L258.582 541.118L174.251 608.589C168.429 613.247 167.486 621.742 172.143 627.564C176.801 633.386 185.297 634.329 191.119 629.672L285.991 553.767ZM14.137 264.962L115.685 279.111L119.411 252.37L17.863 238.22L14.137 264.962ZM115.675 279.11C124.838 280.393 137.255 284.582 145.467 291.97C149.386 295.495 152.093 299.505 153.39 304.121C154.673 308.691 154.864 314.873 152.117 323.271L177.779 331.665C181.924 318.993 182.328 307.301 179.383 296.818C176.451 286.381 170.485 278.159 163.524 271.897C149.977 259.71 131.801 254.105 119.421 252.371L115.675 279.11ZM152.117 323.271C138.318 365.454 116.39 433.697 107.154 462.535L132.868 470.771C142.103 441.936 164.009 373.762 177.779 331.665L152.117 323.271ZM107.417 461.79C103.048 473.105 100.107 491.199 107.229 508.197C114.878 526.454 132.585 539.935 162.404 543.488L165.599 516.678C143.043 513.99 135.175 505.027 132.132 497.764C128.562 489.244 129.814 478.743 132.605 471.516L107.417 461.79ZM162.404 543.488C214.816 549.734 260.003 554.859 276.067 556.643L279.047 529.808C263.054 528.032 217.939 522.915 165.599 516.678L162.404 543.488Z" fill="currentColor"></path>
                <path class="fill-cyan-500" d="M229.298 165.61C225.217 159.371 216.85 157.621 210.61 161.702C204.371 165.783 202.621 174.15 206.702 180.39L229.298 165.61ZM703.921 410.871C711.364 410.433 717.042 404.045 716.605 396.602L709.47 275.311C709.032 267.868 702.643 262.189 695.2 262.627C687.757 263.065 682.079 269.454 682.516 276.897L688.858 384.71L581.045 391.052C573.602 391.49 567.923 397.879 568.361 405.322C568.799 412.765 575.187 418.444 582.63 418.006L703.921 410.871ZM206.702 180.39C239.898 231.14 343.567 329.577 496.595 322.758L495.394 295.785C354.802 302.049 259.09 211.158 229.298 165.61L206.702 180.39ZM496.595 322.758C567.523 319.598 610.272 335.61 637.959 353.957C651.944 363.225 662.493 373.355 671.17 382.695C675.584 387.447 679.351 391.81 683.115 396.047C686.719 400.103 690.432 404.172 694.159 407.484L712.097 387.304C709.691 385.166 706.92 382.189 703.298 378.113C699.837 374.217 695.636 369.362 690.951 364.319C681.43 354.07 669.255 342.306 652.874 331.451C619.829 309.553 571.276 292.404 495.394 295.785L496.595 322.758Z" fill="currentColor"></path>
            </svg>
        </div>

        <div aria-hidden="true" class="absolute -right-24 top-2/4 hidden -translate-y-2/4 translate-x-40 transform animate-bounce md:block lg:translate-x-80">
            <svg class="h-auto w-72" fill="none" height="636" viewBox="0 0 1115 636" width="1115" xmlns="http://www.w3.org/2000/svg">
                <path class="fill-orange-500" d="M0.990203 279.321C-1.11035 287.334 3.68307 295.534 11.6966 297.634L142.285 331.865C150.298 333.965 158.497 329.172 160.598 321.158C162.699 313.145 157.905 304.946 149.892 302.845L33.8132 272.418L64.2403 156.339C66.3409 148.326 61.5475 140.127 53.5339 138.026C45.5204 135.926 37.3213 140.719 35.2207 148.733L0.990203 279.321ZM424.31 252.289C431.581 256.26 440.694 253.585 444.664 246.314C448.635 239.044 445.961 229.931 438.69 225.96L424.31 252.289ZM23.0706 296.074C72.7581 267.025 123.056 230.059 187.043 212.864C249.583 196.057 325.63 198.393 424.31 252.289L438.69 225.96C333.77 168.656 249.817 164.929 179.257 183.892C110.144 202.465 54.2419 243.099 7.92943 270.175L23.0706 296.074Z" fill="currentColor"></path>
                <path class="fill-cyan-500" d="M451.609 382.417C446.219 388.708 446.95 398.178 453.241 403.567L555.763 491.398C562.054 496.788 571.524 496.057 576.913 489.766C582.303 483.474 581.572 474.005 575.281 468.615L484.15 390.544L562.222 299.413C567.612 293.122 566.881 283.652 560.59 278.263C554.299 272.873 544.829 273.604 539.44 279.895L451.609 382.417ZM837.202 559.655C841.706 566.608 850.994 568.593 857.947 564.09C864.9 559.586 866.885 550.298 862.381 543.345L837.202 559.655ZM464.154 407.131C508.387 403.718 570.802 395.25 638.136 410.928C704.591 426.401 776.318 465.66 837.202 559.655L862.381 543.345C797.144 442.631 718.724 398.89 644.939 381.709C572.033 364.734 504.114 373.958 461.846 377.22L464.154 407.131Z" fill="currentColor"></path>
                <path class="fill-gray-800 dark:fill-white" d="M447.448 0.194357C439.203 -0.605554 431.87 5.43034 431.07 13.6759L418.035 148.045C417.235 156.291 423.271 163.623 431.516 164.423C439.762 165.223 447.095 159.187 447.895 150.942L459.482 31.5025L578.921 43.0895C587.166 43.8894 594.499 37.8535 595.299 29.6079C596.099 21.3624 590.063 14.0296 581.818 13.2297L447.448 0.194357ZM1086.03 431.727C1089.68 439.166 1098.66 442.239 1106.1 438.593C1113.54 434.946 1116.62 425.96 1112.97 418.521L1086.03 431.727ZM434.419 24.6572C449.463 42.934 474.586 81.0463 521.375 116.908C568.556 153.07 637.546 187.063 742.018 200.993L745.982 171.256C646.454 157.985 582.444 125.917 539.625 93.0974C496.414 59.978 474.537 26.1903 457.581 5.59138L434.419 24.6572ZM742.018 200.993C939.862 227.372 1054.15 366.703 1086.03 431.727L1112.97 418.521C1077.85 346.879 956.138 199.277 745.982 171.256L742.018 200.993Z" fill="currentColor"></path>
            </svg>
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
