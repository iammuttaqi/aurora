<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">

    <title>@stack('title', config('app.name', 'Laravel'))</title>

    {{-- Favicon --}}
    <link href="{{ asset('assets/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link href="{{ asset('assets/favicon-32x32.png') }}" rel="icon" sizes="32x32" type="image/png">
    <link href="{{ asset('assets/favicon-16x16.png') }}" rel="icon" sizes="16x16" type="image/png">
    <link href="{{ asset('assets/site.webmanifest') }}" rel="manifest">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="scroll-smooth">
    <header class="sticky top-0 z-50 flex w-full flex-wrap border-b border-white/[.5] bg-white py-3 text-sm shadow sm:flex-nowrap sm:justify-start sm:py-0" x-data="{ open: false }">
        <nav aria-label="Global" class="relative mx-auto w-full max-w-[85rem] px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <a aria-label="Brand" class="flex-none text-xl font-semibold text-white" href="{{ route('index') }}" wire:navigate.hover>
                    <x-application-mark class="block h-9 w-auto" />
                </a>
                <div class="sm:hidden">
                    <button aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation" class="hs-collapse-toggle inline-flex items-center justify-center gap-2 rounded-md border border-gray-500 p-2 align-middle text-sm font-medium text-gray-800 shadow-sm transition-all hover:bg-white/[.1] hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white" data-hs-collapse="#navbar-collapse-with-animation" type="button" x-on:click="open = !open">
                        <svg class="hs-collapse-open:hidden h-4 w-4" fill="currentColor" height="16" viewBox="0 0 16 16" width="16">
                            <path d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" fill-rule="evenodd" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden h-4 w-4" fill="currentColor" height="16" viewBox="0 0 16 16" width="16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </div>
            </div>

            @php
                $links =
                    '<div class="mt-5 flex flex-col gap-x-0 gap-y-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end sm:gap-x-7 sm:gap-y-0 sm:pl-7">
                    <a aria-current="page" class="font-medium text-blue-600 sm:py-6" href="' .
                    route('index') .
                    '/#services">Services</a>
                    <a class="font-medium text-blue-600/[.8] hover:text-blue-600 sm:py-6" href="' .
                    route('index') .
                    '/#pricing">Pricing</a>
                    <a class="font-medium text-blue-600/[.8] hover:text-blue-600 sm:py-6" href="' .
                    route('index') .
                    '/#faq">FAQ</a>
                    <a class="font-medium text-blue-600/[.8] hover:text-blue-600 sm:py-6" href="' .
                    route('index') .
                    '/#testimonials">Testimonials</a>
                    <a class="font-medium text-blue-600/[.8] hover:text-blue-600 sm:py-6" href="' .
                    route('index') .
                    '/#features">Features</a>
                    <a class="font-medium text-blue-600/[.8] hover:text-blue-600 sm:py-6" href="' .
                    route('index') .
                    '/#clients">Clients</a>

                    <a class="flex items-center gap-x-2 font-medium text-blue-600/[.8] hover:text-blue-600 sm:my-6 sm:border-l sm:border-blue-600/[.3] sm:pl-6" href="' .
                    route('login') .
                    '" wire:navigate.hover>
                        <i class="bi bi-person-fill"></i>
                        Log in
                    </a>
                </div>';
            @endphp

            <div class="hidden grow basis-full overflow-hidden transition-all duration-300 sm:block">
                {!! $links !!}
            </div>

            <div class="block grow basis-full overflow-hidden transition-all duration-300 sm:hidden" x-cloak x-collapse x-show="open" x-transition.duration.500ms>
                {!! $links !!}
            </div>
        </nav>
    </header>

    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    <footer class="mx-auto w-full max-w-[85rem] px-4 pb-10 sm:px-6 lg:px-8">

        <div class="mt-5 border-t border-gray-200 pt-5">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="flex items-center gap-x-3">
                    <div class="ml-4 space-x-4 text-sm">
                        <span class="inline-flex gap-x-2 text-gray-600 hover:text-gray-800">&copy; {{ date('Y') }} {{ config('app.name') }}</span>
                        <a class="inline-flex gap-x-2 text-gray-600 transition-all hover:text-gray-800 hover:underline" href="{{ route('terms.show') }}" wire:navigate.hover>Terms And Conditions</a>
                        <a class="inline-flex gap-x-2 text-gray-600 transition-all hover:text-gray-800 hover:underline" href="{{ route('policy.show') }}" wire:navigate.hover>Privacy Policy</a>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="mt-3 sm:hidden">
                        <a aria-label="Brand" class="flex-none text-xl font-semibold" href="#">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                        <p class="mt-1 text-xs text-gray-600 sm:text-sm">© {{ date('Y') }} {{ config('app.name') }}.</p>
                    </div>

                    <!-- Social Brands -->
                    <div class="space-x-4">
                        <a class="inline-block text-blue-500 transition-all hover:text-blue-600" href="#">
                            <i class="bi bi-facebook h-4 w-4"></i>
                        </a>
                        <a class="inline-block text-cyan-600 transition-all hover:text-cyan-700" href="#">
                            <i class="bi bi-linkedin h-4 w-4"></i>
                        </a>
                        <a class="inline-block text-cyan-500 hover:text-cyan-600" href="#">
                            <i class="bi bi-twitter h-4 w-4"></i>
                        </a>
                    </div>
                    <!-- End Social Brands -->
                </div>
                <!-- End Col -->
            </div>
        </div>
    </footer>

    @livewireScripts
</body>

</html>
