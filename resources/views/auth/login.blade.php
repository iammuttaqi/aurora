{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('login') }}" class="grid gap-5" method="POST" x-data="{ password: true, processing: false, }" x-on:submit.prevent="processing = true; $el.submit();">
            @csrf

            <div class="flex flex-col gap-1">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input :value="old('email')" autofocus class="block w-full" id="email" name="email" required type="email" />
                <x-input-error for="email" />
            </div>

            <div class="flex flex-col gap-1">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <x-input class="block w-full" id="password" name="password" required x-bind:type="password ? 'password' : 'text'" />
                    <div class="absolute inset-y-0 right-0 z-20 flex items-center pr-4">
                        <button type="button" x-on:click="password = !password">
                            <i class="bi bi-eye-fill text-lg text-gray-500" x-show="password"></i>
                            <i class="bi bi-eye-slash-fill text-lg text-gray-500" x-show="!password"></i>
                        </button>
                    </div>
                </div>
                <x-input-error for="password" />
            </div>

            <div class="block">
                <label class="flex items-center" for="remember_me">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end">
                @if (Route::has('password.request'))
                    <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100" href="{{ route('password.request') }}" wire:navigate.hover>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-4" x-bind:disabled="processing" x-bind:class="processing ? 'dark:bg-gray-400 dark:hover:bg-gray-400' : ''" x-cloak>
                    <span aria-label="loading" class="mr-2 inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-white dark:text-inherit" role="status" x-show="processing"></span>
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

@push('title', 'Login')

<x-guest-layout>
    <main class="mx-auto w-full max-w-md p-6">
        <div class="mt-7 rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="p-4 sm:p-7">
                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Login</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Don't have an account yet?
                        <a class="font-medium text-blue-600 decoration-2 transition-all hover:underline" href="{{ route('register') }}" wire:navigate.hover>
                            Register here
                        </a>
                    </p>
                </div>

                <div class="mt-5">
                    <form action="{{ route('login') }}" class="grid gap-5" method="POST" x-data="{ password: true, password_confirmation: true, processing: false }" x-on:submit.prevent="processing = true; $el.submit();">
                        @csrf
                        <div class="grid gap-y-4">

                            <div class="space-y-1">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input :value="old('email')" class="block w-full" id="email" name="email" required type="email" />
                                <x-input-error for="email" />
                            </div>

                            <div class="space-y-1">
                                <x-label for="password" value="{{ __('Password') }}" />
                                <div class="relative">
                                    <x-input class="block w-full" id="password" name="password" required x-bind:type="password ? 'password' : 'text'" />
                                    <div class="absolute inset-y-0 right-0 z-20 flex items-center pr-4">
                                        <button type="button" x-on:click="password = !password">
                                            <i class="bi bi-eye-fill text-lg text-indigo-500" x-show="password"></i>
                                            <i class="bi bi-eye-slash-fill text-lg text-indigo-500" x-show="!password"></i>
                                        </button>
                                    </div>
                                </div>
                                <x-input-error for="password" />
                            </div>

                            @if (Route::has('password.request'))
                                <div class="space-y-1">
                                    <a class="text-sm text-blue-600 decoration-2 transition-all hover:underline" href="{{ route('password.request') }}" wire:navigate.hover>
                                        {{ __('Forgot your password?') }}
                                    </a>
                                </div>
                            @endif

                            <div class="space-y-1">
                                <x-button x-bind:disabled="processing" x-bind:class="{ 'dark:bg-gray-400 dark:hover:bg-gray-400': processing }" x-cloak>
                                    <span aria-label="loading" class="mr-2 inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-white dark:text-inherit" role="status" x-show="processing"></span>
                                    {{ __('Login') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
    </main>
</x-guest-layout>
