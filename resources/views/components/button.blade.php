<button
    {{ $attributes->merge(['type' => 'submit'])->twMerge('py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-sm border border-transparent bg-blue-800 text-gray-50 hover:bg-blue-900 disabled:opacity-50 disabled:pointer-events-none') }}>
    {{ $slot }}
</button>
