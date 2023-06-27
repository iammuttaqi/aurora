@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')])

<div :class="{ 'bg-indigo-500': style == 'success', 'bg-red-700': style == 'danger', 'bg-gray-500': style != 'success' && style != 'danger' }" class="fixed z-20 w-full" style="display: none;" x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message]) }}" x-init="document.addEventListener('banner-message', event => {
    style = event.detail.style;
    message = event.detail.message;
    show = true;
    setTimeout(() => show = false, 3000);
});" x-on:click.outside="show = false" x-show="show && message" x-transition.duration.500ms>
    <div class="mx-auto max-w-screen-xl py-2 px-3 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between">
            <div class="flex w-0 min-w-0 flex-1 items-center">
                <span :class="{ 'bg-indigo-600': style == 'success', 'bg-red-600': style == 'danger' }" class="flex rounded-lg p-2">
                    <svg class="h-5 w-5 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" x-show="style == 'success'" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg class="h-5 w-5 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" x-show="style == 'danger'" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg class="h-5 w-5 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" x-show="style != 'success' && style != 'danger'" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>

                <p class="ml-3 truncate text-sm font-medium text-white" x-text="message"></p>
            </div>

            <div class="shrink-0 sm:ml-3">
                <button :class="{ 'hover:bg-indigo-600 focus:bg-indigo-600': style == 'success', 'hover:bg-red-600 focus:bg-red-600': style == 'danger' }" aria-label="Dismiss" class="-mr-1 flex rounded-md p-2 transition focus:outline-none sm:-mr-2" type="button" x-on:click="show = false">
                    <svg class="h-5 w-5 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
