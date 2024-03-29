@props(['options' => [], 'id' => 'option', 'selected' => null, 'key' => 'id', 'value_key' => 'title', 'disabled' => false])

<ul {!! $attributes->merge(['class' => 'grid grid-cols-2 gap-5']) !!}>
    @foreach ($options as $option)
        <li>
            <input {{ $selected != null && $selected == $option[$key] ? 'checked' : '' }} {!! $attributes->merge(['class' => 'hidden peer']) !!} id="{{ $id }}_{{ $loop->index + 1 }}" type="radio" value="{{ $option[$key] }}">
            <label class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-5 text-gray-500 transition-all hover:bg-gray-100 hover:text-gray-600 peer-checked:border-blue-600 peer-checked:text-blue-600 peer-disabled:cursor-not-allowed peer-disabled:opacity-50 dark:border-gray-700 dark:bg-slate-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-blue-500" for="{{ $id }}_{{ $loop->index + 1 }}">
                <div class="block">
                    <div class="w-full text-sm font-semibold md:text-lg">{{ $option[$value_key] }}</div>
                </div>
            </label>
        </li>
    @endforeach
</ul>
