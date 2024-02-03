<div>
    <div class="mx-auto max-w-full space-y-8 bg-blue-800 px-4 py-32 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="block text-5xl font-black text-yellow-400 sm:text-6xl md:text-7xl lg:text-8xl">
                College Research and Development Services
            </h1>
        </div>

        <div class="text-center">
            <p class="block text-2xl font-bold text-gray-100 sm:text-3xl md:text-4xl lg:text-5xl">
                Dalubhasaan ng Lungsod ng Lucena
            </p>
        </div>

        <div class="text-center">
            <p class="block text-base font-medium text-gray-100 sm:text-lg md:text-xl lg:text-2xl">
                Welcome to the DLL-CRDS Research Repository, providing free access to research papers by Dalubcenians,
                for
                Dalubcenians.
            </p>
        </div>
    </div>
    <div class="mx-auto max-w-full px-4 pb-8 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between space-y-2 py-8">
            <h1 class="text-4xl font-black text-gray-900">
                Latest News
            </h1>
            <a class="text-lg font-bold text-gray-700 hover:text-blue-800" href="{{ route('all-posts') }}"
                wire:navigate>
                View all &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            @forelse ($latestPosts as $post)
                <x-card href="{{ route('show-post', ['slug' => $post->slug]) }}" wire:navigate
                    wire:key="{{ $post->id }}">
                    <h2 class="text-xl font-bold text-gray-700 group-hover:text-blue-800">
                        {{ $post->title }}
                    </h2>
                    <p class="text-base font-medium text-gray-700">
                        {{ optional($post->category)->name }}
                    </p>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $post->formattedDate() }}
                    </p>
                    <p class="text-sm font-light text-gray-700">
                        {{ $post->formattedContent() }}
                    </p>
                    @if ($post->image_path)
                        <img class="mx-auto aspect-video w-full rounded-md object-cover"
                            src="{{ $post->formattedImage() }}" alt="{{ $post->title }}">
                    @endif
                </x-card>
            @empty
                <p class="text-xl font-bold text-gray-700">
                    No posts yet.
                </p>
            @endforelse
        </div>
    </div>
    <div class="mx-auto max-w-full bg-white px-4 py-8 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-base text-gray-700">
                &copy; {{ date('Y') }} {{ config('app.name', 'DLL-CRDS') }}. All rights reserved.
            </p>
        </div>
    </div>
</div>
