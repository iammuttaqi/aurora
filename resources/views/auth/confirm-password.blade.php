@push('title', 'Confirm Password')

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form action="{{ route('password.confirm') }}" method="POST">
            @csrf

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input autocomplete="current-password" autofocus class="mt-1 block w-full" id="password" name="password" required type="password" />
            </div>

            <div class="mt-4 flex justify-end">
                <x-button class="ml-4">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
