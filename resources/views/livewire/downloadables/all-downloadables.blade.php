<div>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900">
            Resources
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-x-8 lg:grid-cols-3">
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
                    <h2 class="text-xl font-bold text-gray-700 group-hover:text-blue-800">
                        {{ $downloadable->name }}
                    </h2>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $downloadable->formattedDate() }}
                    </p>
                    <p class="text-sm font-light text-gray-700">
                        {{ $downloadable->formattedDescription() }}
                    </p>
                </x-card>
            @empty
                <p class="text-xl font-bold text-gray-700">
                    No resources yet.
                </p>
            @endforelse
        </div>

        <div class="space-y-2 pt-8">
            {{ $downloadables->links() }}
        </div>
    </div>
</div>
