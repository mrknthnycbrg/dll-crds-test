@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'text-sm text-yellow-400 hover:text-yellow-400 focus:outline-none focus:text-yellow-400'
            : 'text-sm text-gray-50 hover:text-yellow-400 focus:outline-none focus:text-yellow-400';
@endphp

<a {{ $attributes->twMerge($classes) }}>
    {{ $slot }}
</a>
