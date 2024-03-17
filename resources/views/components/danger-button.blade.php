<button
    {{ $attributes->merge(['type' => 'button'])->twMerge('py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-sm border border-transparent bg-red-600 text-white hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none') }}>
    {{ $slot }}
</button>
