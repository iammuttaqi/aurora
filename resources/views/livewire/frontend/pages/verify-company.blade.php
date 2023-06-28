@push('title', 'Verify Company')

<div class="bg-gray-100 pt-4 dark:bg-gray-900">
    <div class="flex min-h-screen flex-col items-center pt-6 sm:pt-0">
        <div>
            <x-authentication-card-logo />
        </div>

        <div class="prose dark:prose-invert mt-6 w-full overflow-hidden bg-white p-6 text-center shadow-md dark:bg-gray-800 sm:max-w-2xl sm:rounded-lg">
            @if ($profile)
                <i class="bi bi-shield-fill-check text-[10rem] text-green-500"></i>
                <h1 class="m-0">{{ $profile->name }}</h1>
                <h3 class="mt-2">is a verified company</h3>
            @else
                <i class="bi bi-exclamation-circle-fill text-[10rem] text-red-500"></i>
                <h1 class="m-0">Sorry!</h1>
                <h3 class="mt-2">The Company you are looking for doesn't exist.<br>or the QR code is invalid.</h3>
            @endif
        </div>
    </div>
</div>
