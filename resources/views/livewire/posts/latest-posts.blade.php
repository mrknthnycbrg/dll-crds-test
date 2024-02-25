<div class="mx-auto max-w-full bg-gray-100 px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between space-x-2 py-8">
        <h1 class="text-3xl font-black text-gray-900 underline decoration-amber-400 decoration-4 underline-offset-8">
            Latest News
        </h1>

        <a class="text-lg font-bold text-gray-700 hover:text-cyan-800" href="{{ route('all-posts') }}" wire:navigate>
            View all &rarr;
        </a>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        @forelse ($posts as $post)
            <x-card href="{{ route('show-post', ['slug' => $post->slug]) }}" wire:navigate wire:key="{{ $post->id }}">
                @if ($post->image_path)
                    <img class="mx-auto aspect-video w-full rounded-md object-cover" src="{{ $post->formattedImage() }}"
                        alt="{{ $post->title }}">
                @endif
                <h3 class="text-base font-bold text-gray-700 group-hover:text-cyan-800">
                    {{ $post->title }}
                </h3>
                <p class="text-sm font-light text-gray-700">
                    {{ $post->formattedContent() }}
                </p>
                <p class="text-xs font-thin text-gray-700">
                    {{ $post->formattedDate() }}
                </p>
            </x-card>
        @empty
            <p class="text-lg font-bold text-gray-700">
                No posts yet.
            </p>
        @endforelse
    </div>
</div>
