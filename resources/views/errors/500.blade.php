@push('title', '500')

<x-guest-layout>
    <div class="mx-auto flex h-full w-full max-w-[50rem] flex-col py-20">
        <div class="px-4 py-10 text-center sm:px-6 lg:px-8">
            <h1 class="block text-7xl font-bold text-gray-800 dark:text-white sm:text-9xl">500</h1>
            <h1 class="block text-2xl font-bold text-white"></h1>
            <p class="mt-3 text-gray-600 dark:text-gray-400">Oops, something went wrong.</p>
            <p class="text-gray-600 dark:text-gray-400">Server error.</p>
            <div class="mt-5 flex flex-col items-center justify-center gap-2 sm:flex-row sm:gap-3">
                <button class="inline-flex w-full cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent px-4 py-3 text-sm font-semibold text-blue-500 ring-offset-white transition-all hover:text-blue-700 sm:w-auto" onclick="history.go(-1);return false;" type="button">
                    <i class="bi bi-chevron-left text-lg"></i>
                    Back to previous page
                </button>
            </div>
        </div>
    </div>
</x-guest-layout>
