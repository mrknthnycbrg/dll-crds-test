<div class="min-h-screen bg-gray-100">
    <div class="bg-gray-50">
        <div class="mx-auto max-w-7xl space-y-4 px-4 py-8 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-black text-blue-800">
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
                    <div class="text-center">
                        <x-button type="button" wire:click="file">
                            Download file
                        </x-button>
                    </div>
                @endif
            @else
                <div class="text-center">
                    <x-button type="button" href="{{ route('login') }}" wire:navigate>
                        Please log in to view the file.
                    </x-button>
                </div>
            @endauth
        </div>
    </div>

    @if ($otherDownloadables->isNotEmpty())
        <div class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
            <div class="py-8 text-center">
                <h1 class="text-4xl font-black text-blue-800">
                    Other Resources
                </h1>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3 lg:gap-8">
                @foreach ($otherDownloadables as $otherDownloadable)
                    <x-card href="{{ route('show-downloadable', ['slug' => $otherDownloadable->slug]) }}" wire:navigate
                        wire:key="{{ $otherDownloadable->id }}">
                        <h4 class="text-xl font-semibold text-gray-700 group-hover:text-blue-800">
                            {{ $otherDownloadable->shortenedName() }}
                        </h4>
                        <p class="text-sm font-light text-gray-700">
                            {{ $otherDownloadable->shortenedDescription() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-700">
                            {{ $otherDownloadable->formattedDate() }}
                        </p>
                    </x-card>
                @endforeach
            </div>

            <div class="pt-8 text-center">
                <x-button type="button" href="{{ route('all-downloadables') }}" wire:navigate>
                    View all other resources
                </x-button>
            </div>
        </div>
    @endif
</div>
