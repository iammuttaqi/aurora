@push('title', 'Notifications')

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="flex flex-col" x-data="{
                    notifications: @js($notifications),
                    check_all: @entangle('check_all').defer,
                    checks: @entangle('checks').defer,
                }"
                    x-init="$watch('check_all', value => checks = value ? notifications.data.map(notification => notification.id) : [])">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div
                                class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                                <div class="py-3 px-4 flex justify-between items-center">
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 py-3">
                                        Notifications
                                    </h2>

                                    <div class="inline-flex rounded-md shadow-sm gap-3" x-show="checks.length"
                                        x-transition x-cloak>
                                        <button type="button"
                                            class="py-2 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-green-500 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
                                            wire:click="mark(1)">
                                            Mark As Read
                                        </button>
                                        <button type="button"
                                            class="py-2 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-yellow-500 text-white hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
                                            wire:click="mark(0)">
                                            Mark As Unread
                                        </button>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col" class="py-3 px-4 pr-0">
                                                    <div class="flex items-center h-5">
                                                        <input id="hs-table-pagination-checkbox-all" type="checkbox"
                                                            class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 cursor-pointer"
                                                            x-model="check_all">
                                                        <label for="hs-table-pagination-checkbox-all"
                                                            class="sr-only">Checkbox</label>
                                                    </div>
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Notication</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Date & Time</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach ($notifications as $notification)
                                            <tr class="{{ !$notification->read_at ? 'dark:bg-gray-700' : '' }}">
                                                <td class="py-3 pl-4">
                                                    <div class="flex items-center h-5">
                                                        <input id="hs-table-pagination-checkbox-{{ $loop->index+1 }}"
                                                            type="checkbox"
                                                            class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 cursor-pointer"
                                                            x-model="checks" value="{{ $notification->id }}">
                                                        <label for="hs-table-pagination-checkbox-{{ $loop->index+1 }}"
                                                            class="sr-only">Checkbox</label>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {!! $notification->message !!}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $notification->created_at->format('Y-m-d | h:i A') }}</td>
                                            </tr>
                                            @endforeach
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