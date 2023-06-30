@push('title', 'Notifications')

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <div class="flex flex-col" x-data="{
                    notifications: @js($notifications),
                    check_all: @entangle('check_all').defer,
                    checks: @entangle('checks').defer,
                }" x-init="$watch('check_all', value => checks = value ? notifications.data.map(notification => notification.id) : [])">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="inline-block min-w-full p-1.5 align-middle">
                            <div class="divide-y divide-gray-200 rounded-lg border dark:divide-gray-700 dark:border-gray-700">
                                <div class="flex items-center justify-between py-3 px-4">
                                    <h2 class="py-3 text-xl font-semibold text-gray-800 dark:text-gray-200">
                                        Notifications
                                    </h2>

                                    <div class="inline-flex gap-3 rounded-md shadow-sm" x-cloak x-show="checks.length" x-transition>
                                        <button class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-green-500 py-2 px-4 text-sm font-semibold text-white transition-all hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" type="button" wire:click="mark(1)">
                                            Mark As Read
                                        </button>
                                        <button class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-yellow-500 py-2 px-4 text-sm font-semibold text-white transition-all hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" type="button" wire:click="mark(0)">
                                            Mark As Unread
                                        </button>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th class="py-3 px-4 pr-0" scope="col">
                                                    <div class="flex h-5 items-center">
                                                        <input class="cursor-pointer rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800" id="hs-table-pagination-checkbox-all" type="checkbox" x-model="check_all">
                                                        <label class="sr-only" for="hs-table-pagination-checkbox-all">Checkbox</label>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">
                                                    Notication</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">
                                                    Date & Time</th>
                                                {{-- <th class="px-6 py-3 text-right text-xs font-medium uppercase text-gray-500" scope="col">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @forelse ($notifications as $notification)
                                                <tr class="{{ !$notification->read_at ? 'dark:bg-gray-700' : '' }}">
                                                    <td class="py-3 pl-4">
                                                        <div class="flex h-5 items-center">
                                                            <input class="cursor-pointer rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800" id="hs-table-pagination-checkbox-{{ $loop->index + 1 }}" type="checkbox" value="{{ $notification->id }}" x-model="checks">
                                                            <label class="sr-only" for="hs-table-pagination-checkbox-{{ $loop->index + 1 }}">Checkbox</label>
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        {!! $notification->message !!}</td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $notification->created_at->format('Y-m-d | h:i A') }}</td>
                                                    {{-- <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                                        <a class="text-green-500 transition-all hover:text-green-600" href="{{ route('notifications.show', $notification->id) }}">View</a>
                                                    </td> --}}
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="py-5 text-center text-red-500" colspan="10">Notifications empty</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="grid place-items-center">
                                    {{ $notifications->links('components.pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
