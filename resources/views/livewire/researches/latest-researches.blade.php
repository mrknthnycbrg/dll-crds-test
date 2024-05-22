<div class="min-h-screen bg-gray-100">
    @if ($latestResearches->isNotEmpty())
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="pb-8 text-center">
                <h1 class="text-4xl font-black text-blue-800">
                    Latest Researches
                </h1>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3 lg:gap-8">
                @foreach ($latestResearches as $latestResearch)
                    <x-card href="{{ route('show-research', ['slug' => $latestResearch->slug]) }}" wire:navigate
                        wire:key="{{ $latestResearch->id }}">
                        <x-badge>
                            {{ optional($latestResearch->department)->name }}
                        </x-badge>
                        <h4 class="text-xl font-semibold text-gray-700 group-hover:text-blue-800">
                            {{ $latestResearch->shortenedTitle() }}
                        </h4>
                        <p class="text-sm font-light text-gray-700">
                            {{ $latestResearch->shortenedAbstract() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-700">
                            {{ $latestResearch->formattedDate() }}
                        </p>
                    </x-card>
                @endforeach
            </div>

            <div class="pt-8 text-center">
                <x-button type="button" href="{{ route('all-researches') }}" wire:navigate>
                    View all researches
                </x-button>
            </div>
        </div>
    @endif
</div>
