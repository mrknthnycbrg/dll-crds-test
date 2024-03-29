<div class="min-h-screen">
    <x-header>
        <h1 class="text-4xl font-black text-gray-900 underline decoration-yellow-400 decoration-4 underline-offset-8">
            Resources
        </h1>
    </x-header>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-x-4 sm:gap-x-6 lg:grid-cols-3 lg:gap-x-8">
            <div class="mb-8">
                <x-label for="year" value="Year" />
                <x-select class="mt-1 block w-full" id="year" wire:model.live.debounce="selectedYear"
                    :default="'All Years'" :options="$years" />
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            @forelse ($downloadables as $downloadable)
                <x-card href="{{ route('show-downloadable', ['slug' => $downloadable->slug]) }}" wire:navigate
                    wire:key="{{ $downloadable->id }}">
                    <h4 class="text-xl font-semibold text-gray-700 group-hover:text-blue-800">
                        {{ $downloadable->name }}
                    </h4>
                    <p class="text-sm font-light text-gray-700">
                        {{ $downloadable->formattedDescription() }}
                    </p>
                    <p class="text-xs font-extralight text-gray-700">
                        {{ $downloadable->formattedDate() }}
                    </p>
                </x-card>
            @empty
                <p class="text-base font-normal text-gray-700">
                    No resources yet.
                </p>
            @endforelse
        </div>

        <div class="pt-8">
            {{ $downloadables->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
