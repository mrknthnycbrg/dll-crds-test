@props(['active'])

@php
    $classes = $active ?? false ? 'py-4 px-1 inline-flex items-center gap-2 border-b-2 border-blue-800 text-sm font-medium whitespace-nowrap text-blue-800 focus:outline-none focus:text-blue-800' : 'py-4 px-1 inline-flex items-center gap-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-700 hover:text-blue-800 focus:outline-none focus:text-blue-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
