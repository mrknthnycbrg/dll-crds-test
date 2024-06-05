<div>
    <x-header>
        <h1 class="text-4xl font-black text-blue-800 underline decoration-yellow-400 underline-offset-8">
            Tools
        </h1>
    </x-header>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="pb-8">
            <h2 class="text-3xl font-extrabold text-gray-950">
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

            @if ($output)
                <div class="w-full space-y-4">
                    {{ $output }}
                </div>
            @endif
        </div>

        <div class="pb-8">
            <h2 class="text-3xl font-extrabold text-gray-950">
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

            @if ($similarTitles->isNotEmpty())
                <div class="w-full space-y-4">
                    <h3 class="text-2xl font-bold text-gray-950">
                        Similar Titles:
                    </h3>
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr>
                                <th class="border-b p-2">
                                    Title
                                </th>
                                <th class="border-b p-2">
                                    Similarity
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($similarTitles as $similarTitle)
                                <tr wire:key="title-{{ $loop->index }}">
                                    <td class="border-b p-2">
                                        {{ $similarTitle->title }}
                                    </td>
                                    <td class="border-b p-2">
                                        {{ $similarTitle->percentage }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif ($titleCheckInput)
                <div class="w-full space-y-4">
                    <p class="text-base font-normal text-gray-900">
                        No similar titles.
                    </p>
                </div>
            @endif
        </div>

        <div class="pb-8">
            <h2 class="text-3xl font-extrabold text-gray-950">
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

            @if ($similarAbstracts->isNotEmpty())
                <div class="w-full space-y-4">
                    <h3 class="text-2xl font-bold text-gray-950">
                        Similar Abstracts:
                    </h3>
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr>
                                <th class="border-b p-2">
                                    Title
                                </th>
                                <th class="border-b p-2">
                                    Abstract
                                </th>
                                <th class="border-b p-2">
                                    Similarity
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($similarAbstracts as $similarAbstract)
                                <tr wire:key="abstract-{{ $loop->index }}">
                                    <td class="border-b p-2">
                                        {{ $similarAbstract->title }}
                                    </td>
                                    <td class="border-b p-2">
                                        {{ $similarAbstract->abstract }}
                                    </td>
                                    <td class="border-b p-2">
                                        {{ $similarAbstract->percentage }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif ($abstractCheckInput)
                <div class="w-full space-y-4">
                    <p class="text-base font-normal text-gray-900">
                        No similar abstracts.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
