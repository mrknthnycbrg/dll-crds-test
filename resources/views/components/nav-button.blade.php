@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex w-full items-center text-sm text-blue-800 hover:text-blue-800 focus:outline-none focus:text-blue-800'
            : 'flex w-full items-center text-sm text-gray-700 hover:text-blue-800 focus:outline-none focus:text-blue-800';
@endphp

<button {{ $attributes->merge(['type' => 'button'])->twMerge($classes) }}>
    {{ $slot }}

    <svg class="size-4 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
    </svg>
</button>
