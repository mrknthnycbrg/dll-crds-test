<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-md border border-transparent bg-cyan-800 text-white hover:bg-cyan-900 disabled:opacity-50 disabled:pointer-events-none']) }}>
    {{ $slot }}
</button>
