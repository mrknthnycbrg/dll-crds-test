<div>
    <x-header>
        <h1 class="text-4xl font-black text-gray-900 underline decoration-amber-400 decoration-4 underline-offset-8">
            Tools
        </h1>
    </x-header>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between space-y-2 pb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">
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
            <h2 class="text-3xl font-extrabold text-gray-900">
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
                    <h3 class="text-2xl font-bold text-gray-900">
                        Similar Titles:
                    </h3>
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr>
                                <th class="border-b p-2">Title</th>
                                <th class="border-b p-2">Similarity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($similarTitles as $similarTitle)
                                <tr>
                                    <td class="border-b p-2">
                                        {{ $similarTitle['title'] }}
                                    </td>
                                    <td class="border-b p-2">
                                        {{ $similarTitle['percentage'] }} similarity
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                @if (!empty($titleCheckInput))
                    <div class="w-full space-y-4">
                        <p class="text-base font-normal text-gray-700">
                            No similar titles.
                        </p>
                    </div>
                @endif
            @endif
        </div>

        <div class="flex items-center justify-between space-y-2 pb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">
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
                    <h3 class="text-2xl font-bold text-gray-900">
                        Similar Abstracts:
                    </h3>
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr>
                                <th class="border-b p-2">Abstract</th>
                                <th class="border-b p-2">Similarity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($similarAbstracts as $similarAbstract)
                                <tr>
                                    <td class="border-b p-2">
                                        {{ $similarAbstract['abstract'] }}
                                    </td>
                                    <td class="border-b p-2">
                                        {{ $similarAbstract['percentage'] }} similarity
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                @if (!empty($abstractCheckInput))
                    <div class="w-full space-y-4">
                        <p class="text-base font-normal text-gray-700">
                            No similar abstracts.
                        </p>
                    </div>
                @endif
            @endif
        </div>

    </div>
</div>
