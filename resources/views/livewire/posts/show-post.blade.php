<div>
    <div class="mx-auto max-w-full bg-gray-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-full space-y-4">
            <h1 class="text-4xl font-black text-gray-900">
                {{ $post->title }}
            </h1>
            <p class="text-sm font-light text-gray-700">
                {{ $post->formattedDate() }}
            </p>

            @if ($post->image_path)
                <img class="mx-auto aspect-auto w-full max-w-2xl rounded-sm object-cover"
                    src="{{ $post->formattedImage() }}" alt="{{ $post->title }}">
            @endif

            <div class="prose max-w-none">
                {!! $post->content !!}
            </div>

            <x-badge>
                {{ optional($post->category)->name }}
            </x-badge>
        </div>
    </div>

    @if ($otherPosts->isNotEmpty())
        <div class="mx-auto max-w-full px-4 pb-8 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between space-x-2 py-8">
                <h2
                    class="text-3xl font-extrabold text-gray-900 underline decoration-yellow-400 decoration-4 underline-offset-8">
                    Other News
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
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
                            {{ optional($otherPost->category)->name }}
                        </x-badge>
                        <h4 class="text-xl font-semibold text-gray-700 group-hover:text-blue-800">
                            {{ $otherPost->title }}
                        </h4>
                        <p class="text-sm font-light text-gray-700">
                            {{ $otherPost->formattedContent() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-700">
                            {{ $otherPost->formattedDate() }}
                        </p>
                    </x-card>
                @endforeach
            </div>
        </div>
    @endif
</div>
