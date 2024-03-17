<div>
    <x-header>
        <h1 class="text-4xl font-black text-gray-900 underline decoration-yellow-400 decoration-4 underline-offset-8">
            News
        </h1>
    </x-header>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-x-4 sm:gap-x-6 lg:grid-cols-3 lg:gap-x-8">
            <div class="mb-8">
                <x-label for="year" value="Year" />
                <x-select class="mt-1 block w-full" id="year" wire:model.live.debounce="selectedYear"
                    :default="'All Years'" :options="$years" />
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            @forelse ($posts as $post)
                <x-card href="{{ route('show-post', ['slug' => $post->slug]) }}" wire:navigate
                    wire:key="{{ $post->id }}">
                    @if ($post->image_path)
                        <img class="aspect-video w-full rounded-sm object-cover" src="{{ $post->formattedImage() }}"
                            alt="{{ $post->title }}">
                    @else
                        <img class="aspect-video w-full rounded-sm object-cover" src="{{ asset('images/logo.png') }}"
                            alt="{{ $post->title }}">
                    @endif

                    <h4 class="text-xl font-semibold text-gray-700 group-hover:text-blue-800">
                        {{ $post->title }}
                    </h4>
                    <p class="text-sm font-light text-gray-700">
                        {{ $post->formattedContent() }}
                    </p>
                    <p class="text-xs font-extralight text-gray-700">
                        {{ $post->formattedDate() }}
                    </p>
                </x-card>
            @empty
                <p class="text-base font-normal text-gray-700">
                    No posts yet.
                </p>
            @endforelse
        </div>

        <div class="pt-8">
            {{ $posts->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
