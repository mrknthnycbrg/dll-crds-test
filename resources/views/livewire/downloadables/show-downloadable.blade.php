<div class="bg-gray-100">
    <div class="bg-gray-50">
        <div class="mx-auto max-w-7xl space-y-4 px-4 py-8 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-black text-gray-950">
                {{ $downloadable->title }}
            </h1>
            <p class="text-sm font-light text-gray-900">
                By <span class="font-medium">{{ $downloadable->author->name }}</span>,
                published on <span class="font-medium">{{ $downloadable->formattedDate() }}</span>
            </p>

            <div
                class="prose max-w-none marker:text-gray-900 prose-headings:text-gray-950 prose-p:text-gray-900 prose-a:text-gray-900 hover:prose-a:text-blue-800 prose-blockquote:text-gray-900 prose-pre:bg-gray-200 prose-pre:text-gray-900 prose-li:text-gray-900">
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

    @if ($otherDownloadables->count() > 1)
        <div class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
            <div class="py-8 text-center">
                <h1 class="text-4xl font-black text-blue-800 underline decoration-yellow-400 underline-offset-8">
                    Other Resources
                </h1>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3 lg:gap-8">
                @foreach ($otherDownloadables as $otherDownloadable)
                    <x-card href="{{ route('show-downloadable', ['slug' => $otherDownloadable->slug]) }}" wire:navigate
                        wire:key="{{ $otherDownloadable->id }}">
                        <h4 class="text-xl font-semibold text-gray-950 group-hover:text-blue-800">
                            {{ $otherDownloadable->shortenedTitle() }}
                        </h4>
                        <p class="text-sm font-light text-gray-900">
                            {{ $otherDownloadable->shortenedDescription() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-900">
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
