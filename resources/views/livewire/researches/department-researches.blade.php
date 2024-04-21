<div>
    <x-header>
        <div class="grid gap-8 sm:grid-cols-1 lg:grid-cols-3">
            <div class="col-span-3 lg:col-span-2">
                <h1
                    class="text-4xl font-black text-gray-900 underline decoration-yellow-400 decoration-4 underline-offset-8">
                    Researches in {{ $department->abbreviation }}
                </h1>
            </div>

            <div class="col-span-3 sm:col-span-1">
                <div class="relative flex items-center">
                    <x-input class="block w-full pl-10 pr-3 placeholder-gray-500" type="text"
                        wire:model.live.debounce="search" placeholder="Explore researches" />
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <x-search-icon class="size-6 block text-gray-500" />
                    </div>
                </div>
            </div>
        </div>
    </x-header>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        @if (!$search)
            <div class="grid grid-cols-1 gap-x-4 sm:gap-x-6 lg:grid-cols-3 lg:gap-x-8">
                <div class="mb-4">
                    <x-label for="adviser" value="Adviser" />
                    <x-select class="mt-1 block w-full" id="adviser" wire:model.live.debounce="selectedAdviser"
                        :default="'All Advisers'" :options="$advisers" />
                </div>

                <div class="mb-8">
                    <x-label for="year" value="Year" />
                    <x-select class="mt-1 block w-full" id="year" wire:model.live.debounce="selectedYear"
                        :default="'All Years'" :options="$years" />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                @forelse ($researches as $research)
                    <x-card href="{{ route('show-research', ['slug' => $research->slug]) }}" wire:navigate
                        wire:key="{{ $research->id }}">
                        <x-badge>
                            {{ optional($research->department)->name }}
                        </x-badge>
                        <h4 class="text-xl font-semibold text-gray-700 group-hover:text-blue-800">
                            {{ $research->title }}
                        </h4>
                        <p class="text-sm font-light text-gray-700">
                            {{ $research->formattedAbstract() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-700">
                            {{ $research->formattedDate() }}
                        </p>
                    </x-card>
                @empty
                    <p class="text-base font-normal text-gray-700">
                        No researches yet.
                    </p>
                @endforelse
            </div>

            <div class="pt-8">
                {{ $researches->links(data: ['scrollTo' => false]) }}
            </div>
        @else
            <div class="space-y-2 pb-8">
                <h2 class="text-3xl font-extrabold text-gray-900">
                    Search Results
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                @forelse ($researches as $research)
                    <x-card href="{{ route('show-research', ['slug' => $research->slug]) }}" wire:navigate
                        wire:key="{{ $research->id }}">
                        <x-badge>
                            {{ optional($research->department)->name }}
                        </x-badge>
                        <h4 class="text-xl font-semibold text-gray-700 group-hover:text-blue-800">
                            {{ $research->title }}
                        </h4>
                        <p class="text-sm font-light text-gray-700">
                            {{ $research->formattedAbstract() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-700">
                            {{ $research->formattedDate() }}
                        </p>
                    </x-card>
                @empty
                    <p class="text-base font-normal text-gray-700">
                        No researches found.
                    </p>
                @endforelse
            </div>

            <div class="pt-8">
                {{ $researches->links(data: ['scrollTo' => false]) }}
            </div>
        @endif
    </div>
</div>
