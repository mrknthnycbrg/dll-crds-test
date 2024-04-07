<div>
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
                    Please log in to view the file.
                </x-button>
            @endauth
        </div>
    </div>

    @if ($otherDownloadables->isNotEmpty())
        <div class="mx-auto max-w-full px-4 pb-8 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between space-x-2 py-8">
                <h1
                    class="text-3xl font-extrabold text-gray-900 underline decoration-yellow-400 decoration-4 underline-offset-8">
                    Other Resources
                </h1>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                @foreach ($otherDownloadables as $otherDownloadable)
                    <x-card href="{{ route('show-downloadable', ['slug' => $otherDownloadable->slug]) }}" wire:navigate
                        wire:key="{{ $otherDownloadable->id }}">
                        <h4 class="text-xl font-semibold text-gray-700 group-hover:text-blue-800">
                            {{ $otherDownloadable->name }}
                        </h4>
                        <p class="text-sm font-light text-gray-700">
                            {{ $otherDownloadable->formattedDescription() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-700">
                            {{ $otherDownloadable->formattedDate() }}
                        </p>
                    </x-card>
                @endforeach
            </div>
        </div>
    @endif
</div>
