@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'text-sm text-blue-800 hover:text-blue-800 focus:outline-none focus:text-blue-800'
            : 'text-sm text-gray-700 hover:text-blue-800 focus:outline-none focus:text-blue-800';
@endphp

<a {{ $attributes->twMerge($classes) }}>
    {{ $slot }}
</a>
