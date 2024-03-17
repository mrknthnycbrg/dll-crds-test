@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'py-4 px-1 inline-flex items-center gap-2 border-b-2 border-yellow-400 text-sm font-medium whitespace-nowrap text-yellow-400 focus:outline-none focus:text-yellow-400'
            : 'py-4 px-1 inline-flex items-center gap-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-50 hover:text-yellow-400 focus:outline-none focus:text-yellow-400';
@endphp

<a {{ $attributes->twMerge($classes) }}>
    {{ $slot }}
</a>
