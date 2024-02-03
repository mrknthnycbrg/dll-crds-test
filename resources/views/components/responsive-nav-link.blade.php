@props(['active'])

@php
    $classes = $active ?? false ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-blue-800 text-left text-base font-bold text-blue-800 bg-gray-200 focus:outline-none focus:text-blue-800 focus:bg-gray-200 focus:border-blue-800 transition duration-150 ease-in-out' : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-700 hover:text-blue-800 hover:bg-gray-200 hover:border-blue-800 focus:outline-none focus:text-blue-800 focus:bg-gray-200 focus:border-blue-800 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
