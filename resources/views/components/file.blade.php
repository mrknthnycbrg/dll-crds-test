@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->twMerge(
    'block w-full rounded-md border border-gray-200 text-sm shadow-sm file:me-4 file:border-0 file:bg-white file:px-4 file:py-3 focus:z-10 focus:border-blue-800 focus:ring-blue-800 disabled:pointer-events-none disabled:opacity-50',
) !!}>
