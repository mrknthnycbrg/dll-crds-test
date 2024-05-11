<div>
    @if ($latestResearches->isNotEmpty())
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="pb-8">
                <h1 class="text-4xl font-black text-blue-800">
                    Latest Researches
                </h1>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                @forelse ($latestResearches as $research)
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
                        No latestResearches yet.
                    </p>
                @endforelse
            </div>
        </div>
    @endif
</div>
