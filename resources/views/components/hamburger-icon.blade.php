<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" {{ $attributes }}>
    <path class="inline-flex" :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    <path class="hidden" :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round"
        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
</svg>
