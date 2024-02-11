<div>
    <div class="mx-auto max-w-full bg-blue-800 px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 items-center gap-8 lg:grid-cols-2">
            <div class="my-4 space-y-4">
                <h1 class="block text-6xl font-black text-gray-50">
                    College Research and Development Services
                </h1>
                <p class="text-4xl font-bold text-gray-50">
                    Dalubhasaan ng Lungsod ng Lucena
                </p>
            </div>

            <div class="my-4 space-y-4">
                <x-featured-image class="w-full rounded-md" alt="Featured Image" />
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-full px-4 pb-8 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between space-y-2 py-8">
            <h1 class="text-3xl font-black text-gray-900">
                News
            </h1>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            @forelse ($posts as $post)
                <x-card href="{{ route('show-post', ['slug' => $post->slug]) }}" wire:navigate
                    wire:key="{{ $post->id }}">
                    <h3 class="text-base font-bold text-gray-700 group-hover:text-blue-800">
                        {{ $post->title }}
                    </h3>
                    <p class="text-sm font-light text-gray-700">
                        {{ $post->formattedContent() }}
                    </p>
                    <p class="text-xs font-thin text-gray-700">
                        {{ $post->formattedDate() }}
                    </p>
                    @if ($post->image_path)
                        <img class="mx-auto aspect-video w-full rounded-md object-cover"
                            src="{{ $post->formattedImage() }}" alt="{{ $post->title }}">
                    @endif
                </x-card>
            @empty
                <p class="text-lg font-bold text-gray-700">
                    No posts yet.
                </p>
            @endforelse
        </div>

        <div class="space-y-2 pt-8">
            {{ $posts->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <div class="mx-auto max-w-full bg-gray-200 px-4 py-8 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-sm text-gray-700">
                &copy; {{ date('Y') }} {{ config('app.name', 'DLL-CRDS') }}. All rights reserved.
            </p>
        </div>
    </div>
</div>
