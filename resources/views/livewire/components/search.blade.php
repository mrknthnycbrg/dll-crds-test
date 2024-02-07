<div>
    <div class="flex justify-center py-8">
        <div class="relative flex w-full items-center sm:w-full md:w-2/3 lg:w-1/3">
            <x-input class="block w-full pl-10 placeholder-gray-500" type="text" wire:model.live.debounce="search"
                placeholder="Explore researches" />
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <x-search-icon class="size-6 block text-gray-500" />
            </div>
        </div>
    </div>

    @if ($search)
        <div class="space-y-2 pb-8">
            <h2 class="text-3xl font-black text-gray-900">
                Search Results
            </h2>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            @forelse ($researches as $research)
                <x-card href="{{ route('show-research', ['slug' => $research->slug]) }}" wire:navigate
                    wire:key="{{ $research->id }}">
                    <h3 class="text-lg font-bold text-gray-700 group-hover:text-blue-800">
                        {{ $research->title }}
                    </h3>
                    <p class="text-base font-medium text-gray-700">
                        {{ optional($research->department)->name }}
                    </p>
                    <p class="text-sm font-light text-gray-700">
                        {{ $research->formattedAbstract() }}
                    </p>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $research->formattedDate() }}
                    </p>
                </x-card>
            @empty
                <p class="text-lg font-bold text-gray-700">
                    No researches found.
                </p>
            @endforelse
        </div>

        <div class="space-y-2 pt-8">
            {{ $researches->links(data: ['scrollTo' => false]) }}
        </div>
    @endif
</div>
