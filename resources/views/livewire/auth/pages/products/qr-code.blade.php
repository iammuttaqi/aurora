@push('title', $product->title . ' QR Code')

@push('styles')
    <style>
        svg {
            width: 20rem;
        }
    </style>
@endpush

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $product->title . ' ' . __('QR Code') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                {{-- <button class="m-3 rounded-md bg-green-500 px-3 py-2 text-white transition-all hover:bg-green-600" type="button" wire:click="download()">Download</button> --}}
                <form wire:submit="download('{{ $product->serial_number }}')">
                    <x-button class="m-3" loading="download">
                        {{ __('Download') }}
                    </x-button>
                </form>
                <div class="flex justify-center">
                    <div>{!! $product->qr_code !!}</div>
                </div>

            </div>
        </div>
    </div>
</div>
