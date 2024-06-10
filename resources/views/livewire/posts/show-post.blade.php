<div class="bg-gray-100">
    <div class="bg-gray-50">
        <div class="mx-auto max-w-7xl space-y-4 px-4 py-8 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-black text-gray-950">
                {{ $post->title }}
            </h1>
            <p class="text-sm font-light text-gray-900">
                {{ $post->formattedDate() }}
            </p>

            @if ($post->image_path)
                <img class="mx-auto aspect-auto w-full max-w-2xl rounded-sm object-cover"
                    src="{{ $post->formattedImage() }}" alt="{{ $post->title }}">
            @endif

            <div
                class="prose max-w-none marker:text-gray-900 prose-headings:text-gray-950 prose-p:text-gray-900 prose-a:text-gray-900 hover:prose-a:text-blue-800 prose-blockquote:text-gray-900 prose-pre:bg-gray-200 prose-pre:text-gray-900 prose-li:text-gray-900">
                {!! $post->content !!}
            </div>

            <x-badge>
                {{ $post->category->name }}
            </x-badge>
        </div>
    </div>

    @if ($otherPosts->isNotEmpty())
        <div class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
            <div class="py-8 text-center">
                <h1 class="text-4xl font-black text-blue-800 underline decoration-yellow-400 underline-offset-8">
                    Other News
                </h1>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3 lg:gap-8">
                @foreach ($otherPosts as $otherPost)
                    <x-card href="{{ route('show-post', ['slug' => $otherPost->slug]) }}" wire:navigate
                        wire:key="{{ $otherPost->id }}">
                        @if ($otherPost->image_path)
                            <img class="aspect-video w-full rounded-sm object-cover"
                                src="{{ $otherPost->formattedImage() }}" alt="{{ $otherPost->title }}">
                        @else
                            <img class="aspect-video w-full rounded-sm object-cover"
                                src="{{ asset('images/logo.png') }}" alt="{{ $otherPost->title }}">
                        @endif
                        <x-badge>
                            {{ $otherPost->category->name }}
                        </x-badge>
                        <h4 class="text-xl font-semibold text-gray-950 group-hover:text-blue-800">
                            {{ $otherPost->shortenedTitle() }}
                        </h4>
                        <p class="text-sm font-light text-gray-900">
                            {{ $otherPost->shortenedContent() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-900">
                            {{ $otherPost->formattedDate() }}
                        </p>
                    </x-card>
                @endforeach
            </div>

            <div class="pt-8 text-center">
                <x-button type="button" href="{{ route('category-posts', ['slug' => $otherPost->category->slug]) }}"
                    wire:navigate>
                    View all other news
                </x-button>
            </div>
        </div>
    @endif
</div>
