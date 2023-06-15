<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
        @endif

        <form class="grid gap-5" method="POST" action="{{ route('login') }}"
            x-data="{ password: true, processing: false, }" x-on:submit.prevent="processing = true; $el.submit();">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <x-input id="password" class="block mt-1 w-full" x-bind:type="password ? 'password' : 'text'"
                        name="password" required />
                    <div class="absolute inset-y-0 right-0 flex items-center z-20 pr-4">
                        <button type="button" x-on:click="password = !password">
                            <i class="bi bi-eye h-4 w-4 text-gray-400" x-show="password"></i>
                            <i class="bi bi-eye-slash h-4 w-4 text-gray-400" x-show="!password"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="block">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-button class="ml-4" x-bind:disabled="processing"
                    x-bind:class="processing ? 'dark:bg-gray-400 dark:hover:bg-gray-400' : ''" x-cloak>
                    <span
                        class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-white rounded-full dark:text-inherit mr-2"
                        role="status" aria-label="loading" x-show="processing"></span>
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>