<div class="mx-auto min-h-screen max-w-full bg-gray-50 px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl space-y-4">
        <h1 class="text-4xl font-black text-gray-900">
            {{ $post->title }}
        </h1>
        <p class="text-sm font-light text-gray-700">
            {{ $post->formattedDate() }}
        </p>

        @if ($post->image_path)
            <img class="mx-auto aspect-auto w-full max-w-2xl rounded-sm object-cover" src="{{ $post->formattedImage() }}"
                alt="{{ $post->title }}">
        @endif

        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>
    </div>
</div>
