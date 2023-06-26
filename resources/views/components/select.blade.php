@props(['options' => [], 'selected' => null, 'key' => 'id', 'value_key' => 'title', 'default' => 'Select...', 'disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full',
]) !!}>
    <option disabled selected value="">{{ $default }}</option>
    @foreach ($options as $option)
        <option {{ $selected && $selected == $option[$key] ? 'selected' : '' }} value="{{ $option[$key] }}">
            {{ $option[$value_key] }}
        </option>
    @endforeach
</select>
