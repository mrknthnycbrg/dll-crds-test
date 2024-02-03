<div>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900">
            Researches
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-x-8 lg:grid-cols-3">
            <div class="mb-4">
                <x-label for="department" value="Department" />
                <x-select class="mt-1 block w-full" id="department" wire:model.live.debounce="selectedDepartment"
                    :default="'All Departments'" :options="$departments" />
            </div>

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
                    <h2 class="text-xl font-bold text-gray-700 group-hover:text-blue-800">
                        {{ $research->title }}
                    </h2>
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
                <p class="text-xl font-bold text-gray-700">
                    No researches yet.
                </p>
            @endforelse
        </div>

        <div class="space-y-2 pt-8">
            {{ $researches->links() }}
        </div>
    </div>
</div>
