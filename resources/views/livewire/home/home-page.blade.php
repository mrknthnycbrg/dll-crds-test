<div>
    <x-slot name="header">
        <livewire:components.search />
    </x-slot>

    <div class="mx-auto max-w-full px-4 pb-8 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between space-y-2 py-8">
            <h1 class="text-4xl font-black text-gray-900">
                Latest Researches
            </h1>

            <a class="text-lg font-bold text-gray-700 hover:text-blue-800" href="{{ route('all-researches') }}"
                wire:navigate>
                View all &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            @forelse ($latestResearches as $research)
                <x-card href="{{ route('show-research', ['slug' => $research->slug]) }}" wire:navigate
                    wire:key="{{ $research->id }}">
                    <h3 class="text-lg font-bold text-gray-700 group-hover:text-blue-800">
                        {{ $research->title }}
                    </h3>
                    <p class="text-base font-medium text-gray-700">
                        {{ optional($research->department)->name }}
                    </p>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $research->formattedDate() }}
                    </p>
                    <p class="text-sm font-light text-gray-700">
                        {{ $research->formattedAbstract() }}
                    </p>
                </x-card>
            @empty
                <p class="text-lg font-bold text-gray-700">
                    No researches yet.
                </p>
            @endforelse
        </div>
    </div>
</div>
