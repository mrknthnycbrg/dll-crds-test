@props(['for'])

@error($for)
    <p {{ $attributes->twMerge('text-sm text-red-600') }}>
        {{ $message }}</p>
@enderror
