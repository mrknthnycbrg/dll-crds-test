<div>
    <x-slot name="header">
        <h1 class="text-3xl font-black text-gray-900">
            Tools
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between space-y-2 pb-8">
            <h2 class="text-2xl font-black text-gray-900">
                Title Generator
            </h2>
        </div>

        <div class="flex flex-col items-center pb-8">
            <form class="flex w-full items-center justify-center space-x-2 pb-8" wire:submit.prevent="response">
                <x-input class="block w-full" type="text" placeholder="Enter a topic to generate research title ideas"
                    required wire:model="input" />
                <x-button wire:target="response" wire:loading.attr="disabled">
                    Generate
                </x-button>
            </form>

            @if (!empty($output))
                <div class="w-full space-y-4">
                    {{ $output }}
                </div>
            @endif
        </div>

        <div class="flex items-center justify-between space-y-2 pb-8">
            <h2 class="text-2xl font-black text-gray-900">
                Title Similarity Checker
            </h2>
        </div>

        <div class="flex flex-col items-center pb-8">
            <form class="flex w-full items-center justify-center space-x-2 pb-8"
                wire:submit.prevent="titleCheckerResponse">
                <x-input class="block w-full" type="text" placeholder="Enter a title to check for similarity"
                    required wire:model="titleCheckInput" />
                <x-button wire:target="titleCheckerResponse" wire:loading.attr="disabled">
                    Check
                </x-button>
            </form>

            @if (!empty($similarTitles))
                <div class="w-full space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">Similar Titles:</h2>
                    @foreach ($similarTitles as $similarTitle)
                        <ul class="list-disc pl-8">
                            <li>
                                <span class="font-bold">{{ $similarTitle['title'] }}</span>
                                - {{ $similarTitle['percentage'] }} similarity
                            </li>
                        </ul>
                    @endforeach
                </div>
            @else
                @if (!empty($titleCheckInput))
                    <div class="w-full space-y-4">
                        <p class="text-gray-700">No similar titles.</p>
                    </div>
                @endif
            @endif
        </div>

        <div class="flex items-center justify-between space-y-2 pb-8">
            <h2 class="text-2xl font-black text-gray-900">
                Abstract Similarity Checker
            </h2>
        </div>

        <div class="flex flex-col items-center pb-8">
            <form class="flex w-full items-center justify-center space-x-2 pb-8"
                wire:submit.prevent="abstractCheckerResponse">
                <x-input class="block w-full" type="text" placeholder="Enter an abstract to check for similarity"
                    required wire:model="abstractCheckInput" />
                <x-button wire:target="abstractCheckerResponse" wire:loading.attr="disabled">
                    Check
                </x-button>
            </form>

            @if (!empty($similarAbstracts))
                <div class="w-full space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">Similar Abstracts:</h2>
                    @foreach ($similarAbstracts as $similarAbstract)
                        <ul class="list-disc pl-8">
                            <li>
                                <span class="font-bold">{{ $similarAbstract['abstract'] }}</span>
                                - {{ $similarAbstract['percentage'] }} similarity
                            </li>
                        </ul>
                    @endforeach
                </div>
            @else
                @if (!empty($abstractCheckInput))
                    <div class="w-full space-y-4">
                        <p class="text-gray-700">No similar abstracts.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
