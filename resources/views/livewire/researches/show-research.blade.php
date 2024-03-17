<div class="mx-auto max-w-full bg-gray-50 px-4 py-8 sm:px-6 lg:px-8">
    <div class="max-w-full space-y-4">
        <h1 class="text-4xl font-black text-gray-900">
            {{ $research->title }}
        </h1>

        @if ($research->award_id)
            <x-badge class="bg-yellow-400 text-gray-900">
                {{ optional($research->award)->name }}
            </x-badge>
        @endif

        <p class="text-base font-normal text-gray-700">
            <span class="font-medium text-gray-900">
                Department:
            </span>
            {{ optional($research->department)->name }}
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
                Adviser:
            </span>
            {{ optional($research->adviser)->name }}
        </p>

        @if ($research->category_id)
            <p class="text-base font-normal text-gray-700">
                <span class="font-medium text-gray-900">
                    Category:
                </span>
                {{ optional($research->category)->name }}
            </p>
        @endif

        @if ($research->client_id)
            <p class="text-base font-normal text-gray-700">
                <span class="font-medium text-gray-900">
                    Client:
                </span>
                {{ optional($research->client)->name }}
            </p>
        @endif

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

            @if ($research->image_path)
                <img class="mx-auto aspect-auto w-full max-w-2xl rounded-md object-cover"
                    src="{{ $research->formattedImage() }}" alt="{{ $research->title }}">
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
