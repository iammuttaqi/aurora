@push('title', 'Dashboard')

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent lg:p-8">
                    <div class="flex items-center gap-5">
                        <img alt="Logo" class="w-10" src="{{ Vite::asset('resources/images/logo.png') }}">
                        <span class="text-3xl font-bold text-white">{{ config('app.name') }}</span>
                    </div>

                    <div class="mt-8 flex items-start justify-between">
                        <div class="space-y-8">
                            <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                                Welcome to your Dashboard, <strong>{{ auth()->user()->name }}</strong>
                            </h1>
                            @if (auth()->user()->profile && auth()->user()->profile->username)
                                <div class="relative z-20 flex items-center" x-data="{
                                    copyText: @js(auth()->user()->profile->username),
                                    copyNotification: false,
                                    copyToClipboard() {
                                        navigator.clipboard.writeText(this.copyText);
                                        this.copyNotification = true;
                                        let that = this;
                                        setTimeout(function() {
                                            that.copyNotification = false;
                                        }, 3000);
                                    }
                                }">
                                    <button class="group flex h-8 w-auto cursor-pointer items-center justify-center rounded-md bg-yellow-100 px-3 py-1 text-xs text-black" x-on:click="copyToClipboard();">
                                        <span x-text="copyText"></span>
                                        <i class="bi bi-clipboard ml-2" x-show="!copyNotification"></i>
                                        <i class="bi bi-clipboard-check ml-2 text-green-500" x-cloak x-show="copyNotification"></i>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <span class="rounded-md bg-blue-100 px-3 py-1.5 text-base font-medium text-blue-800">
                            You are logged in as a <strong>{{ auth()->user()->role->title }}</strong>
                        </span>
                    </div>
                </div>

                <div class="border-b border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800 lg:p-8">
                    <div class="mx-auto">
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
                            @foreach ($items as $item)
                                <div class="flex flex-col rounded-xl border bg-white shadow-sm dark:border-gray-800 dark:bg-slate-900">
                                    <div class="p-4 md:p-5">
                                        <div class="flex items-center gap-x-2">
                                            <p class="text-xs uppercase tracking-wide text-gray-500">{{ $item['title'] }}</p>
                                        </div>

                                        <div class="mt-1 flex items-center gap-x-2">
                                            <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200 sm:text-2xl">
                                                {{ $item['details'] }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
