@props(['value'])

<label {{ $attributes->twMerge('block text-sm font-medium mb-2 text-gray-700') }}>
    {{ $value ?? $slot }}
</label>
