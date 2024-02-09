<div>
    <div class="bg-gray-50">
        <div class="flex justify-center px-4 py-16 sm:px-6 lg:px-8">
            <div class="relative flex w-full items-center md:w-2/3 lg:w-1/3">
                <x-input class="block w-full pl-10 placeholder-gray-500" type="text" wire:model.live.debounce="search"
                    placeholder="Explore researches" />
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-search-icon class="size-6 block text-gray-500" />
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
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
                        @if ($research->image_path)
                            <img class="mx-auto aspect-video w-full rounded-md object-cover"
                                src="{{ $research->formattedImage() }}" alt="{{ $research->title }}">
                        @endif
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
            <div class="space-y-2">
                <h1 class="text-3xl font-black text-gray-900">
                    Latest Researches
                </h1>
            </div>

            @forelse ($departments as $department)
                <div class="flex items-center justify-between space-y-2 py-8">
                    <h2 class="text-2xl font-black text-gray-900">
                        {{ $department->name }}
                    </h2>

                    @if ($department->researches->isNotEmpty())
                        <a class="text-lg font-bold text-gray-700 hover:text-blue-800"
                            href="{{ route('department-researches', ['slug' => $department->slug]) }}" wire:navigate>
                            View all &rarr;
                        </a>
                    @endif
                </div>

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    @forelse ($researches->where('department_id', $department->id) as $research)
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
                            @if ($research->image_path)
                                <img class="mx-auto aspect-video w-full rounded-md object-cover"
                                    src="{{ $research->formattedImage() }}" alt="{{ $research->title }}">
                            @endif
                        </x-card>
                    @empty
                        <p class="text-lg font-bold text-gray-700">
                            No researches in this department yet.
                        </p>
                    @endforelse
                </div>
            @empty
                <p class="text-lg font-bold text-gray-700">
                    No departments with researches yet.
                </p>
            @endforelse
        @endif
    </div>
</div>
