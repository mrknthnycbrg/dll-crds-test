<div class="bg-gray-100">
    <x-header>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:gap-8">
            <div class="col-span-1">
                <h1 class="text-4xl font-black text-blue-800 underline decoration-yellow-400 underline-offset-8">
                    Resources
                </h1>
            </div>

            <div class="col-span-1">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 start-0 z-20 flex items-center ps-3">
                        <x-search-icon class="size-6 flex-shrink-0 text-gray-500" />
                    </div>
                    <x-input class="pe-4 ps-10 placeholder-gray-500" type="text" wire:model.live.debounce="search"
                        placeholder="Explore resources" />
                </div>
            </div>
        </div>
    </x-header>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if (!$search)
            <div class="grid grid-cols-1 gap-x-4 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-3 lg:gap-x-8">
                <div class="mb-8">
                    <x-label for="year" value="Year" />
                    <x-select class="mt-1 block w-full" id="year" wire:model.live.debounce="selectedYear"
                        :default="'All Years'" :options="$years" />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3 lg:gap-8">
                @forelse ($downloadables as $downloadable)
                    <x-card href="{{ route('show-downloadable', ['slug' => $downloadable->slug]) }}" wire:navigate
                        wire:key="{{ $downloadable->id }}">
                        <h4 class="text-xl font-semibold text-gray-950 group-hover:text-blue-800">
                            {{ $downloadable->shortenedTitle() }}
                        </h4>
                        <p class="text-sm font-light text-gray-900">
                            {{ $downloadable->shortenedDescription() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-900">
                            {{ $downloadable->formattedDate() }}
                        </p>
                    </x-card>
                @empty
                    <p class="text-base font-normal text-gray-900">
                        No resources yet.
                    </p>
                @endforelse
            </div>

            <div class="pt-8">
                {{ $downloadables->links(data: ['scrollTo' => false]) }}
            </div>
        @else
            <div class="space-y-2 pb-8">
                <h2 class="text-3xl font-extrabold text-gray-950">
                    Search Results
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3 lg:gap-8">
                @forelse ($downloadables as $downloadable)
                    <x-card href="{{ route('show-downloadable', ['slug' => $downloadable->slug]) }}" wire:navigate
                        wire:key="{{ $downloadable->id }}">
                        <h4 class="text-xl font-semibold text-gray-950 group-hover:text-blue-800">
                            {{ $downloadable->shortenedTitle() }}
                        </h4>
                        <p class="text-sm font-light text-gray-900">
                            {{ $downloadable->shortenedDescription() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-900">
                            {{ $downloadable->formattedDate() }}
                        </p>
                    </x-card>
                @empty
                    <p class="text-base font-normal text-gray-900">
                        No resources found.
                    </p>
                @endforelse
            </div>

            <div class="pt-8">
                {{ $downloadables->links(data: ['scrollTo' => false]) }}
            </div>
        @endif
    </div>
</div>
