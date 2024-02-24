<div>
    <x-slot name="header">
        <h1 class="text-3xl font-black text-gray-900">
            Researches
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-x-4 sm:gap-x-6 lg:grid-cols-3 lg:gap-x-8">
            <div class="flex justify-start pb-8">
                <div class="relative flex w-full items-center">
                    <x-input class="block w-full pl-10 placeholder-gray-500" type="text"
                        wire:model.live.debounce="search" placeholder="Explore researches" />
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <x-search-icon class="size-6 block text-gray-500" />
                    </div>
                </div>
            </div>
        </div>

        @if ($search)
            <div class="space-y-2 pb-8">
                <h1 class="text-3xl font-black text-gray-900">
                    Search Results
                </h1>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                @forelse ($researches as $research)
                    <x-card href="{{ route('show-research', ['slug' => $research->slug]) }}" wire:navigate
                        wire:key="{{ $research->id }}">
                        @if ($research->image_path)
                            <img class="mx-auto aspect-video w-full rounded-md object-cover"
                                src="{{ $research->formattedImage() }}" alt="{{ $research->title }}">
                        @endif
                        <div class="pt-4">
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
                        </div>
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
        @else
            <div class="grid grid-cols-2 gap-x-4 sm:gap-x-6 lg:grid-cols-3 lg:gap-x-8">
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
                        @if ($research->image_path)
                            <img class="mx-auto aspect-video w-full rounded-md object-cover"
                                src="{{ $research->formattedImage() }}" alt="{{ $research->title }}">
                        @endif
                        <div class="pt-4">
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
                        </div>
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
        @endif
    </div>
</div>
