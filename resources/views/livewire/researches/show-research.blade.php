<div>
    <div class="mx-auto max-w-full bg-gray-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl space-y-4">
            <h1 class="text-4xl font-black text-gray-900">
                {{ $research->title }}
            </h1>
            <p class="text-base font-normal text-gray-700">
                <span class="font-medium text-gray-900">
                    Department:
                </span>
                {{ optional($research->department)->name }}
            </p>
            <p class="text-base font-normal text-gray-700">
                <span class="font-medium text-gray-900">
                    Section:
                </span>
                {{ optional($research->yearSection)->name }}
            </p>
            <p class="text-base font-normal text-gray-700">
                <span class="font-medium text-gray-900">
                    Adviser:
                </span>
                {{ optional($research->adviser)->name }}
            </p>
            <p class="text-base font-normal text-gray-700">
                <span class="font-medium text-gray-900">
                    Date Submitted:
                </span>
                {{ $research->formattedDate() }}
            </p>
            <p class="text-base font-normal text-gray-700">
                <span class="font-medium text-gray-900">
                    Authors:
                </span>
                {{ $research->author }}
            </p>
            <p class="text-base font-normal text-gray-700">
                <span class="font-medium text-gray-900">
                    Keywords:
                </span>
                {{ $research->keyword }}
            </p>
            <p class="text-base font-medium text-gray-900">
                Abstract:
            </p>

            @auth
                <div class="prose max-w-none">
                    {!! $research->abstract !!}
                </div>

                @if ($research->file_path)
                    <x-button type="button" wire:click="file">
                        View
                    </x-button>
                @endif
            @else
                <p class="text-base font-normal text-gray-700">
                    {{ $research->formattedAbstract() }}
                </p>

                <x-button type="button" href="{{ route('login') }}" wire:navigate>
                    Please log in to view the full abstract.
                </x-button>
            @endauth
        </div>
    </div>

    @if ($otherResearches->isNotEmpty())
        <div class="mx-auto max-w-full px-4 pb-8 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between space-x-2 py-8">
                <h1
                    class="text-4xl font-black text-gray-900 underline decoration-yellow-400 decoration-4 underline-offset-8">
                    Other Researches
                </h1>
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
