@push('title', 'Register')

<x-guest-layout>
    <main class="mx-auto w-full max-w-md p-6">
        <div class="mt-7 rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="p-4 sm:p-7">
                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Register</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Already have an account?
                        <a class="font-medium text-blue-600 decoration-2 transition-all hover:underline" href="{{ route('login') }}" wire:navigate.hover>
                            Login here
                        </a>
                    </p>
                </div>

                <div class="mt-5">
                    <!-- Form -->
                    <form action="{{ route('register') }}" class="grid gap-5" method="POST" x-data="{ password: true, password_confirmation: true, processing: false }" x-on:submit.prevent="processing = true; $el.submit();">
                        @csrf
                        <div class="grid gap-y-4">
                            <div class="space-y-1">
                                <x-label for="role_id" value="{{ __('Role') }}" />
                                <x-radio-advanced :options="$roles" :selected="old('role_id')" id="role_id" name="role_id" />
                                <x-input-error for="role_id" />
                            </div>

                            <div class="space-y-1">
                                <x-label for="name" value="{{ __('Name') }}" />
                                <x-input :value="old('name')" class="block w-full" id="name" name="name" required type="text" />
                                <x-input-error for="name" />
                            </div>

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

                            <div class="space-y-1">
                                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <div class="relative">
                                    <x-input class="block w-full" id="password_confirmation" name="password_confirmation" required x-bind:type="password_confirmation ? 'password' : 'text'" />
                                    <div class="absolute inset-y-0 right-0 z-20 flex items-center pr-4">
                                        <button type="button" x-on:click="password_confirmation = !password_confirmation">
                                            <i class="bi bi-eye-fill text-lg text-indigo-500" x-show="password_confirmation"></i>
                                            <i class="bi bi-eye-slash-fill text-lg text-indigo-500" x-show="!password_confirmation"></i>
                                        </button>
                                    </div>
                                </div>
                                <x-input-error for="password_confirmation" />
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="space-y-1">
                                    <x-label for="terms">
                                        <div class="flex items-center">
                                            <x-checkbox id="terms" name="terms" required />

                                            <div class="ml-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' => '<a wire:navigate.hover target="_blank" href="' . route('terms.show') . '"class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">' . __('Terms of Service') . '</a>',
                                                    'privacy_policy' => '<a wire:navigate.hover target="_blank" href="' . route('policy.show') . '"class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">' . __('Privacy Policy') . '</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-label>
                                </div>
                            @endif

                            <div class="space-y-1">
                                <x-button x-bind:disabled="processing" x-bind:class="{ 'dark:bg-gray-400 dark:hover:bg-gray-400': processing }" x-cloak>
                                    <span aria-label="loading" class="mr-2 inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-white dark:text-inherit" role="status" x-show="processing"></span>
                                    {{ __('Register') }}
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
