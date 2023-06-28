@push('title', config('app.name'))

<div class="bg-gray-100 pt-4 dark:bg-gray-900">
    <div class="flex min-h-screen flex-col items-center pt-6 sm:pt-0">
        <div>
            <x-authentication-card-logo />
        </div>

        @if (Route::has('login'))
            <div class="z-10 p-6 text-right sm:fixed sm:top-0 sm:right-0">
                @auth
                    <a class="font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500 dark:text-gray-400 dark:hover:text-white" href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a class="font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500 dark:text-gray-400 dark:hover:text-white" href="{{ route('login') }}">Log
                        in</a>

                    @if (Route::has('register'))
                        <a class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500 dark:text-gray-400 dark:hover:text-white" href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="prose dark:prose-invert mt-6 w-full overflow-hidden bg-white p-6 shadow-md dark:bg-gray-800 sm:max-w-2xl sm:rounded-lg">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam amet soluta perferendis sed temporibus et inventore velit dolorum impedit, alias cumque voluptatem, dignissimos, necessitatibus quidem tenetur modi ratione odio aliquam?
        </div>
    </div>
</div>
