@props(['active'])

@php
    $classes = $active ?? false ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-amber-400 text-left text-base font-bold text-amber-400 bg-cyan-900 focus:outline-none focus:text-amber-400 focus:bg-cyan-900 focus:border-amber-400 transition duration-150 ease-in-out' : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-50 hover:text-amber-400 hover:bg-cyan-900 hover:border-amber-400 focus:outline-none focus:text-amber-400 focus:bg-cyan-900 focus:border-amber-400 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
