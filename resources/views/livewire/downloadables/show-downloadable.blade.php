<div class="mx-auto max-w-full bg-white px-4 py-8 sm:px-6 lg:px-8">
    <div class="max-w-full space-y-4">
        <h1 class="text-4xl font-black text-gray-900">
            {{ $downloadable->name }}
        </h1>
        <p class="text-sm font-medium text-gray-700">
            {{ $downloadable->formattedDate() }}
        </p>
        <div class="prose max-w-none">
            {!! $downloadable->description !!}
        </div>
        @if ($downloadable->file_path)
            <x-button wire:click="file">
                Download File
            </x-button>
        @endif
    </div>
</div>
