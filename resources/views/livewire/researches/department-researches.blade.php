<div>
    <x-header>
        <h1 class="text-3xl font-black text-gray-900 underline decoration-amber-400 decoration-4 underline-offset-8">
            Researches in {{ $department->name }}
        </h1>
    </x-header>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-x-4 sm:gap-x-6 lg:grid-cols-3 lg:gap-x-8">
            <div class="mb-4">
                <x-label for="adviser" value="Adviser" />
                <x-select class="mt-1 block w-full" id="adviser" wire:model.live.debounce="selectedAdviser"
                    :default="'All Advisers'" :options="$advisers" />
            </div>

            <div class="mb-4">
                <x-label for="category" value="Category" />
                <x-select class="mt-1 block w-full" id="category" wire:model.live.debounce="selectedCategory"
                    :default="'All Categories'" :options="$categories" />
            </div>

            <div class="mb-4">
                <x-label for="client" value="Client" />
                <x-select class="mt-1 block w-full" id="client" wire:model.live.debounce="selectedClient"
                    :default="'All Clients'" :options="$clients" />
            </div>

            <div class="mb-4">
                <x-label for="award" value="Award" />
                <x-select class="mt-1 block w-full" id="award" wire:model.live.debounce="selectedAward"
                    :default="'All Awards'" :options="$awards" />
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
                    <h3 class="text-base font-bold text-gray-700 group-hover:text-cyan-800">
                        {{ $research->title }}
                    </h3>
                    <p class="text-sm font-medium text-gray-700">
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
                    No researches yet.
                </p>
            @endforelse
        </div>

        <div class="space-y-2 pt-8">
            {{ $researches->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
