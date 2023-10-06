@props(['options' => [], 'selected' => null, 'key' => 'id', 'value_key' => 'title', 'default' => 'Select...', 'disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 transition-all disabled:opacity-50 disabled:cursor-not-allowed',
]) !!}>
    <option disabled selected value="">{{ $default }}</option>
    @foreach ($options as $option)
        <option {{ $selected && $selected == $option[$key] ? 'selected' : '' }} value="{{ $option[$key] }}">
            {{ $option[$value_key] }}
        </option>
    @endforeach
</select>
