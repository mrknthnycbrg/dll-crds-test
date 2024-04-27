<div>
    <div class="mx-auto max-w-full bg-gray-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-full space-y-4">
            <h1 class="text-4xl font-black text-gray-900">
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
                        <p class="text-base font-normal text-gray-700">
                            {{ $research->abstract }}
                        </p>

                        @if ($research->file_path)
                            <x-button type="button" wire:click="file">
                                View
                            </x-button>
                        @endif
                    </div>
                @else
                    <div class="space-y-4">
                        <p class="text-base font-normal text-gray-700">
                            {{ $research->formattedAbstract() }}
                        </p>

                        <x-button type="button" href="{{ route('login') }}" wire:navigate>
                            Please log in to view the full abstract.
                        </x-button>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    @if ($otherResearches->isNotEmpty())
        <div class="mx-auto max-w-full px-4 pb-8 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between space-x-2 py-8">
                <h2
                    class="text-3xl font-extrabold text-gray-900 underline decoration-yellow-400 decoration-4 underline-offset-8">
                    Other Researches
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                @foreach ($otherResearches as $otherResearch)
                    <x-card href="{{ route('show-research', ['slug' => $otherResearch->slug]) }}" wire:navigate
                        wire:key="{{ $otherResearch->id }}">
                        <x-badge>
                            {{ optional($otherResearch->department)->name }}
                        </x-badge>
                        <h4 class="text-xl font-semibold text-gray-700 group-hover:text-blue-800">
                            {{ $otherResearch->title }}
                        </h4>
                        <p class="text-sm font-light text-gray-700">
                            {{ $otherResearch->formattedAbstract() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-700">
                            {{ $otherResearch->formattedDate() }}
                        </p>
                    </x-card>
                @endforeach
            </div>
        </div>
    @endif
</div>
