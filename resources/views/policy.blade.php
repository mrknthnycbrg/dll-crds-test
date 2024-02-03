<x-guest-layout>
    <div class="flex flex-col items-center p-8 sm:justify-center">
        <div>
            <x-application-logo class="size-28 block" href="{{ route('welcome') }}" role="button" wire:navigate />
        </div>

        <div class="prose mt-6 w-full overflow-hidden bg-white p-6 shadow-md sm:rounded-lg">
            {!! $policy !!}
        </div>
    </div>
</x-guest-layout>
