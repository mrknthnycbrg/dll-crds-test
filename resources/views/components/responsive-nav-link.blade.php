@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-yellow-400 text-left text-base font-bold text-yellow-400 bg-blue-900 focus:outline-none focus:text-yellow-400 focus:bg-blue-900 focus:border-yellow-400 transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-50 hover:text-yellow-400 hover:bg-blue-900 hover:border-yellow-400 focus:outline-none focus:text-yellow-400 focus:bg-blue-900 focus:border-yellow-400 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->twMerge($classes) }}>
    {{ $slot }}
</a>
