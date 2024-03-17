@props(['on'])

<div style="display: none;" x-data="{ shown: false, timeout: null }" x-init="@this.on('{{ $on }}', () => {
    clearTimeout(timeout);
    shown = true;
    timeout = setTimeout(() => { shown = false }, 2000);
})"
    x-show.transition.out.opacity.duration.1500ms="shown" x-transition:leave.opacity.duration.1500ms
    {{ $attributes->twMerge('text-sm text-gray-600') }}>
    {{ $slot->isEmpty() ? 'Saved.' : $slot }}
</div>
