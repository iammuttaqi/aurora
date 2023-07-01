<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form action="{{ route('register') }}" class="grid gap-5" method="POST" x-data="{ password: true, password_confirmation: true, processing: false }" x-on:submit.prevent="processing = true; $el.submit();">
            @csrf

            <div class="flex flex-col gap-1">
                <x-label for="role_id" value="{{ __('Role') }}" />
                <x-radio-advanced :options="$roles" :full="true" :selected="old('role_id')" id="role_id" name="role_id" />
                <x-input-error for="role_id" />
            </div>

            <div class="flex flex-col gap-1">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input :value="old('name')" class="block w-full" id="name" name="name" required type="text" />
                <x-input-error for="name" />
            </div>

            <div class="flex flex-col gap-1">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input :value="old('email')" class="block w-full" id="email" name="email" required type="email" />
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

            <div class="flex flex-col gap-1">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <div class="relative">
                    <x-input class="block w-full" id="password_confirmation" name="password_confirmation" required x-bind:type="password_confirmation ? 'password' : 'text'" />
                    <div class="absolute inset-y-0 right-0 z-20 flex items-center pr-4">
                        <button type="button" x-on:click="password_confirmation = !password_confirmation">
                            <i class="bi bi-eye-fill text-lg text-gray-500" x-show="password_confirmation"></i>
                            <i class="bi bi-eye-slash-fill text-lg text-gray-500" x-show="!password_confirmation"></i>
                        </button>
                    </div>
                </div>
                <x-input-error for="password_confirmation" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div>
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox id="terms" name="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '"class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' . __('Terms of Service') . '</a>',
                                    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '"class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' . __('Privacy Policy') . '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end">
                <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4" x-bind:disabled="processing" x-bind:class="{ 'dark:bg-gray-400 dark:hover:bg-gray-400': processing }" x-cloak>
                    <span aria-label="loading" class="mr-2 inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-white dark:text-inherit" role="status" x-show="processing"></span>
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
