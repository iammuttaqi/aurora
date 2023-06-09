<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form class="grid gap-5" method="POST" action="{{ route('register') }}"
            x-data="{ password: true, password_confirmation: true }">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
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

            <div>
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <div class="relative">
                    <x-input id="password_confirmation" class="block mt-1 w-full"
                        x-bind:type="password_confirmation ? 'password' : 'text'" name="password_confirmation"
                        required />
                    <div class="absolute inset-y-0 right-0 flex items-center z-20 pr-4">
                        <button type="button" x-on:click="password_confirmation = !password_confirmation">
                            <i class="bi bi-eye h-4 w-4 text-gray-400" x-show="password_confirmation"></i>
                            <i class="bi bi-eye-slash h-4 w-4 text-gray-400" x-show="!password_confirmation"></i>
                        </button>
                    </div>
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div>
                <x-label for="terms">
                    <div class="flex items-center">
                        <x-checkbox name="terms" id="terms" required />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms
                                of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy
                                Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-label>
            </div>
            @endif

            <div class="flex items-center justify-end">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">{{ __('Register') }}</x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>