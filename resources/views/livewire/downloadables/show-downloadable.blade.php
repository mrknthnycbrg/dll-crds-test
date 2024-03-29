<div class="mx-auto max-w-full bg-gray-50 px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl space-y-4">
        <h1 class="text-4xl font-black text-gray-900">
            {{ $downloadable->name }}
        </h1>
        <p class="text-sm font-light text-gray-700">
            {{ $downloadable->formattedDate() }}
        </p>

        <div class="prose max-w-none">
            {!! $downloadable->description !!}
        </div>

        @auth
            @if ($downloadable->file_path)
                <x-button type="button" wire:click="file">
                    Download File
                </x-button>
            @endif
        @else
            <x-button type="button" href="{{ route('login') }}" wire:navigate>
                Please log in to download the file.
            </x-button>
        @endauth
    </div>
</div>
