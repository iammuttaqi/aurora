{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

@push('title', 'Forgot Password')

<x-guest-layout>
    <main class="mx-auto w-full max-w-md p-6">
        <div class="mt-7 rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="p-4 sm:p-7">
                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Forgot password?</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Remember your password?
                        <a class="font-medium text-blue-600 decoration-2 hover:underline" href="{{ route('login') }}" wire:navigate.hover>
                            Sign in here
                        </a>
                    </p>
                </div>

                <div class="mt-5">
                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('password.email') }}" method="POST" x-data="{ processing: false }" x-on:submit.prevent="processing = true; $el.submit();">
                        @csrf
                        <div class="grid gap-y-4">
                            <div class="space-y-1">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input :value="old('email')" class="block w-full" id="email" name="email" required type="email" />
                                <x-input-error for="email" />
                            </div>

                            <div class="space-y-1">
                                <x-button x-bind:disabled="processing" x-bind:class="{ 'dark:bg-gray-400 dark:hover:bg-gray-400': processing }" x-cloak>
                                    <span aria-label="loading" class="inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-white dark:text-inherit" role="status" x-show="processing"></span>
                                    {{ __('Email Password Reset Link') }}
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
