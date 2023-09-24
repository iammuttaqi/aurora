@push('title', 'Reset Password')

<x-guest-layout>
    <main class="mx-auto w-full max-w-md p-6">
        <div class="mt-7 rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="p-4 sm:p-7">

                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Reset Password</h1>
                </div>

                <div class="mt-5">
                    <form action="{{ route('password.update') }}" method="POST" x-data="{ password: true, password_confirmation: true, processing: false }" x-on:submit.prevent="processing = true; $el.submit();">
                        @csrf
                        <div class="grid gap-y-4">
                            <input name="token" type="hidden" value="{{ $request->route('token') }}">

                            <div class="space-y-1">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input :value="old('email', $request->email)" autocomplete="username" autofocus class="block w-full" id="email" name="email" required type="email" />
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

                            <div class="space-y-1">
                                <x-button x-bind:disabled="processing" x-bind:class="{ 'dark:bg-gray-400 dark:hover:bg-gray-400': processing }" x-cloak>
                                    <span aria-label="loading" class="inline-block h-4 w-4 animate-spin rounded-full border-[3px] border-current border-t-transparent text-white dark:text-inherit" role="status" x-show="processing"></span>
                                    {{ __('Reset Password') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>
</x-guest-layout>
