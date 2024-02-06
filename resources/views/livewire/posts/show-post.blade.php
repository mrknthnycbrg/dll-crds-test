<div class="mx-auto max-w-full bg-white px-4 py-8 sm:px-6 lg:px-8">
    <div class="max-w-full space-y-4">
        <h1 class="text-3xl font-black text-gray-900">
            {{ $post->title }}
        </h1>
        <p class="text-sm font-medium text-gray-700">
            {{ $post->formattedDate() }}
        </p>
        @if ($post->image_path)
            <img class="w-4xl mx-auto aspect-video rounded-md object-cover" src="{{ $post->formattedImage() }}"
                alt="{{ $post->title }}">
        @endif
        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>
        <p class="text-sm font-medium text-gray-700">
            {{ optional($post->category)->name }}
        </p>
    </div>
</div>
