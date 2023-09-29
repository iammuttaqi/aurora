<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-bind:class="{ 'dark': dark }" x-cloak x-data="{
    dark: $persist(false),
}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">

    <title>@stack('title', config('app.name', 'Laravel'))</title>

    {{-- Favicon --}}
    <link href="{{ Vite::asset('resources/images/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link href="{{ Vite::asset('resources/images/favicon-32x32.png') }}" rel="icon" sizes="32x32" type="image/png">
    <link href="{{ Vite::asset('resources/images/favicon-16x16.png') }}" rel="icon" sizes="16x16" type="image/png">
    <link href="{{ Vite::asset('resources/images/site.webmanifest') }}" rel="manifest">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Tom Select --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    @stack('cdn')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @stack('scripts')
</body>

</html>
