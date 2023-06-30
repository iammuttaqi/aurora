@push('title', 'Notification Show')

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Notification Show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <div class="relative flex flex-col rounded-xl bg-white shadow-lg dark:bg-gray-800">
                    <!-- Body -->
                    <div class="overflow-y-auto p-4 sm:p-7">
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                {{ $notification->message }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                Time: {{ $notification->created_at->format('Y-m-d h:i:s A') }}
                            </p>
                        </div>

                        <div class="mt-5 sm:mt-10">
                            <h4 class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">Summary</h4>

                            <ul class="mt-3 flex flex-col">
                                @foreach ($notification->data as $key => $value)
                                    @if (is_string($value))
                                        <li class="-mt-px inline-flex items-center gap-x-2 border py-3 px-4 text-sm text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-gray-700 dark:text-gray-200">
                                            <div class="flex w-full items-center justify-between">
                                                <span class="w-1/2 text-left">{{ ucwords(str()->replace('_', ' ', $key)) }}</span>
                                                <span class="w-1/2 text-right">{{ $value }}</span>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- End Body -->
                </div>

            </div>
        </div>
    </div>
</div>
