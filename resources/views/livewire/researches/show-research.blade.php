<div class="min-h-screen bg-gray-100">
    <div class="bg-gray-50">
        <div class="mx-auto max-w-7xl space-y-4 px-4 py-8 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-black text-blue-800">
                {{ $research->title }}
            </h1>

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                <div class="space-y-4">
                    <div>
                        <p class="font-medium text-gray-900">
                            Department:
                        </p>
                        <p class="text-base font-normal text-gray-700">
                            {{ optional($research->department)->name }}
                        </p>
                    </div>

                    <div>
                        <p class="font-medium text-gray-900">
                            Section:
                        </p>
                        <p class="text-base font-normal text-gray-700">
                            {{ optional($research->yearSection)->name }}
                        </p>
                    </div>

                    <div>
                        <p class="font-medium text-gray-900">
                            Adviser:
                        </p>
                        <p class="text-base font-normal text-gray-700">
                            {{ optional($research->adviser)->name }}
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="font-medium text-gray-900">
                            Date Submitted:
                        </p>
                        <p class="text-base font-normal text-gray-700">
                            {{ $research->formattedDate() }}
                        </p>
                    </div>

                    <div>
                        <p class="font-medium text-gray-900">
                            @if (count(explode(',', $research->author)) > 1)
                                Authors:
                            @else
                                Author:
                            @endif
                        </p>
                        <p class="text-base font-normal text-gray-700">
                            {{ $research->author }}
                        </p>
                    </div>

                    <div>
                        <p class="font-medium text-gray-900">
                            Keywords:
                        </p>
                        <p class="text-base font-normal text-gray-700">
                            {{ $research->keyword }}
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <p class="text-base font-medium text-gray-900">
                    Abstract:
                </p>

                @auth
                    <div class="space-y-4">
                        <div class="prose max-w-none">
                            <p class="text-base font-normal text-gray-700">
                                {{ $research->abstract }}
                            </p>
                        </div>

                        @if ($research->file_path)
                            <div class="text-center">
                                <x-button type="button" wire:click="file">
                                    View file
                                </x-button>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="space-y-4">
                        <div class="prose max-w-none">
                            <p class="text-base font-normal text-gray-700">
                                {{ $research->shortenedAbstract() }}
                            </p>
                        </div>

                        <div class="text-center">
                            <x-button type="button" href="{{ route('login') }}" wire:navigate>
                                Please log in to view the full abstract.
                            </x-button>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    @if ($otherResearches->isNotEmpty())
        <div class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
            <div class="py-8 text-center">
                <h1 class="text-4xl font-black text-blue-800">
                    Other Researches
                </h1>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3 lg:gap-8">
                @foreach ($otherResearches as $otherResearch)
                    <x-card href="{{ route('show-research', ['slug' => $otherResearch->slug]) }}" wire:navigate
                        wire:key="{{ $otherResearch->id }}">
                        <x-badge>
                            {{ optional($otherResearch->department)->name }}
                        </x-badge>
                        <h4 class="text-xl font-semibold text-gray-700 group-hover:text-blue-800">
                            {{ $otherResearch->shortenedTitle() }}
                        </h4>
                        <p class="text-sm font-light text-gray-700">
                            {{ $otherResearch->shortenedAbstract() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-700">
                            {{ $otherResearch->formattedDate() }}
                        </p>
                    </x-card>
                @endforeach
            </div>

            <div class="pt-8 text-center">
                <x-button type="button"
                    href="{{ route('department-researches', ['slug' => $otherResearch->department->slug]) }}"
                    wire:navigate>
                    View all other researches
                </x-button>
            </div>
        </div>
    @endif
</div>
