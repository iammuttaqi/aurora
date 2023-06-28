@push('title', 'QR Code')

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('QR Code') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <div class="grid grid-cols-2 place-items-center py-5">
                    <div>{!! $qr_code !!}</div>

                    <form wire:submit.prevent="update">
                        <button class="rounded bg-green-500 px-5 py-3 text-white transition-all hover:bg-green-600" type="submit">Get A New QR Code</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
