@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-800 focus:ring-blue-800 disabled:opacity-50 disabled:pointer-events-none',
]) !!}>
