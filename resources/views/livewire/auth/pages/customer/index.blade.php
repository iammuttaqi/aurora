@push('title', 'Customers')

<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Customers') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto flex max-w-7xl flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="inline-block min-w-full p-1.5 align-middle">
                    <div class="overflow-hidden rounded-lg border dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th colspan="10">
                                        <div class="flex w-full items-start justify-between rounded-t-lg p-5 dark:bg-gray-900">
                                            <div class="flex items-start gap-10">
                                                <div class="text-left">
                                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">List of Customers</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                </tr>

                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Phone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Age</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Gender</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">City</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500" scope="col">Added At</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($customers as $customer)
                                    <tr>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $customer->name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $customer->phone_number }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $customer->email }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $customer->age }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $customer->gender }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $customer->city }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $customer->created_at->format('Y-m-d | h:i A') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-5 text-center text-red-500" colspan="10">Products empty</td>
                                    </tr>
                                @endforelse
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="10">{{ $customers->links('components.pagination-livewire') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
