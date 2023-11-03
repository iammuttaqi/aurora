@push('title', $profile->name . ' QR Code')

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
            {{ $profile->name . __(' QR Code') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <form wire:submit="download('{{ $profile->username }}')">
                    <x-button class="m-3" loading="download">
                        {{ __('Download') }}
                    </x-button>
                    <a class="m-3 underline" href="{{ URL::signedRoute('verify_identity', $profile->username) }}" target="_blank">
                        {{ __('See Timeline') }}
                    </a>
                </form>
                <div class="flex justify-center">
                    <div>{!! $profile->qr_code !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
