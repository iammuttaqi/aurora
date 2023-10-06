@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 transition-all read-only:opacity-50 read-only:cursor-not-allowed disabled:opacity-50 disabled:cursor-not-allowed']) !!}></textarea>
