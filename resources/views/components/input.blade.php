@props(['disabled' => false])

{{-- <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm read-only:dark:bg-gray-700 read-only:cursor-not-allowed']) !!}> --}}

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 transition-all read-only:opacity-50 read-only:cursor-not-allowed disabled:opacity-50 disabled:cursor-not-allowed']) !!}>
