<div class="mx-auto max-w-full bg-white px-4 py-8 sm:px-6 lg:px-8">
    <div class="max-w-full space-y-4">
        <h1 class="text-3xl font-black text-gray-900">
            {{ $research->title }}
        </h1>

        @if ($research->image_path)
            <img class="mx-auto aspect-video max-w-4xl rounded-md object-cover" src="{{ $research->formattedImage() }}"
                alt="{{ $research->title }}">
        @endif

        <p class="text-base text-gray-700">
            <span class="font-extrabold text-gray-900">
                Department:
            </span>
            {{ optional($research->department)->name }}
        </p>
        <p class="text-base text-gray-700">
            <span class="font-extrabold text-gray-900">
                Adviser:
            </span>
            {{ optional($research->adviser)->name }}
        </p>
        <p class="text-base text-gray-700">
            <span class="font-extrabold text-gray-900">
                Date Submitted:
            </span>
            {{ $research->formattedDAte() }}
        </p>
        <p class="text-base text-gray-700">
            <span class="font-extrabold text-gray-900">
                Authors:
            </span>
            {{ $research->author }}
        </p>
        <p class="text-base text-gray-700">
            <span class="font-extrabold text-gray-900">
                Keywords:
            </span>
            {{ $research->keyword }}
        </p>
        <p class="text-base font-extrabold text-gray-900">
            Abstract:
        </p>

        <div class="prose max-w-none">
            {!! $research->abstract !!}
        </div>

        @if ($research->file_path)
            <x-button wire:click="file">
                View
            </x-button>
        @endif
    </div>
</div>
