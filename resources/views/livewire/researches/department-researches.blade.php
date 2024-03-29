<div class="min-h-screen">
    <x-header>
        <h1 class="text-4xl font-black text-gray-900 underline decoration-yellow-400 decoration-4 underline-offset-8">
            Researches in {{ $department->name }}
        </h1>
    </x-header>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-x-4 sm:gap-x-6 lg:grid-cols-4 lg:gap-x-8">
            <div class="mb-4">
                <x-label for="year" value="Year" />
                <x-select class="mt-1 block w-full" id="year" wire:model.live.debounce="selectedYear"
                    :default="'All Years'" :options="$years" />
            </div>

            <div class="mb-4">
                <x-label for="adviser" value="Adviser" />
                <x-select class="mt-1 block w-full" id="adviser" wire:model.live.debounce="selectedAdviser"
                    :default="'All Advisers'" :options="$advisers" />
            </div>

            @if ($categories->isNotEmpty())
                <div class="mb-4">
                    <x-label for="category" value="Category" />
                    <x-select class="mt-1 block w-full" id="category" wire:model.live.debounce="selectedCategory"
                        :default="'All Categories'" :options="$categories" />
                </div>
            @endif

            @if ($clients->isNotEmpty())
                <div class="mb-4">
                    <x-label for="client" value="Client" />
                    <x-select class="mt-1 block w-full" id="client" wire:model.live.debounce="selectedClient"
                        :default="'All Clients'" :options="$clients" />
                </div>
            @endif
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
                    @if ($research->award_id)
                        <x-badge class="bg-yellow-400 text-gray-900">
                            {{ optional($research->award)->name }}
                        </x-badge>
                    @endif
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
    </div>
</div>
