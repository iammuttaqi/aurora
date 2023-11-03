@push('title', 'Partners')

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Partners') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="inline-block min-w-full p-1.5 align-middle">
                            <div class="divide-y divide-gray-200 rounded-lg border dark:divide-gray-700 dark:border-gray-700">
                                <div class="px-4 py-3">
                                    <div class="relative max-w-xs">
                                        <form wire:submit="$refresh">
                                            <label class="sr-only" for="hs-table-with-pagination-search">Search</label>
                                            <input class="block w-full rounded-md border-gray-200 p-3 pl-10 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-slate-900 dark:text-gray-400" id="hs-table-with-pagination-search" placeholder="Search for partners" type="search" wire:model="search">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                                <i class="bi bi-search text-base text-gray-400"></i>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th class="px-4 py-3 pr-0" scope="col">
                                                    <div class="flex h-5 items-center">
                                                        <input class="rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800" id="hs-table-pagination-checkbox-all" type="checkbox">
                                                        <label class="sr-only" for="hs-table-pagination-checkbox-all">Checkbox</label>
                                                    </div>
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Logo</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Name</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Role</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Address</th>
                                                <th class="px-6 py-3 text-right text-xs font-medium uppercase text-gray-500" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @forelse ($partners as $partner)
                                                <tr>
                                                    <td class="py-3 pl-4">
                                                        <div class="flex h-5 items-center">
                                                            <input class="rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800" id="hs-table-pagination-checkbox-1" type="checkbox">
                                                            <label class="sr-only" for="hs-table-pagination-checkbox-1">Checkbox</label>
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        <img class="h-10 w-10 object-contain" src="{{ $partner->logo }}">
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $partner->name }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $partner->user->role->title }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $partner->address }}</td>
                                                    <td class="flex justify-end gap-2 whitespace-nowrap px-6 py-4 text-center text-sm font-medium">
                                                        <a href="{{ URL::signedRoute('verify_identity', $partner->username) }}" target="_blank" title="Check Identity"><i class="bi bi-shield-fill-exclamation rounded bg-red-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-red-600"></i></a>

                                                        @can('qrCode', $partner)
                                                            <a href="{{ route('partners.qr_code', $partner->username) }}" target="_blank" title="QR Code"><i class="bi bi-qr-code rounded bg-blue-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-blue-600"></i></a>
                                                        @endcan

                                                        @can('approvable', $partner)
                                                            <button title="Approve and Assign QR" type="button" wire:loading.attr="disabled" wire:target="approve(@js($partner->id))" x-data x-on:click="confirm('Are you sure?') == true ? $wire.approve(@js($partner->id)) : null">
                                                                <i class="bi bi-check-circle-fill rounded bg-green-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-green-600" wire:loading.class.remove="bg-green-500 hover:bg-green-600" wire:loading.class="bg-green-900" wire:target="approve(@js($partner->id))"></i>
                                                            </button>
                                                        @endcan

                                                        @can('viewPartners', auth()->user())
                                                            <a href="{{ route('partners.show', $partner->username) }}" title=""><i class="bi bi-pen-fill rounded bg-yellow-500 px-2.5 py-2 text-lg text-white transition-all hover:bg-yellow-600"></i></a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="py-5 text-center text-red-500" colspan="10">Nothing found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="grid place-items-center">
                                    {{ $partners->links('components.pagination-livewire') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
