@props(['options' => 4])

<ul {!! $attributes->merge(['class' => 'grid grid-cols-4 gap-5 animate-pulse']) !!}>
    @foreach (range(1, $options) as $range)
        <li>
            <label class="inline-flex w-full cursor-not-allowed items-center justify-between rounded-lg border border-gray-200 bg-gray-100 p-5 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-blue-600 peer-checked:text-blue-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-blue-500">
                <div class="block">
                    <div class="w-full text-sm font-semibold md:text-lg">
                        <p class="block h-7 w-32 bg-gray-200"></p>
                    </div>
                </div>
            </label>
        </li>
    @endforeach
</ul>
