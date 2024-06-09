<div class="bg-gray-100">
    <x-header>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:gap-8">
            <div class="col-span-1 space-y-4">
                <h1 class="text-4xl font-black text-blue-800 underline decoration-yellow-400 underline-offset-8">
                    News
                </h1>
                <x-badge>
                    {{ $category->name }}
                </x-badge>
            </div>

            <div class="col-span-1">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 start-0 z-20 flex items-center ps-3">
                        <x-search-icon class="size-6 flex-shrink-0 text-gray-500" />
                    </div>
                    <x-input class="pe-4 ps-10 placeholder-gray-500" type="text" wire:model.live.debounce="search"
                        placeholder="Explore news" />
                </div>
            </div>
        </div>
    </x-header>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if (!$search)
            <div class="grid grid-cols-1 gap-x-4 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-3 lg:gap-x-8">
                <div class="mb-8">
                    <x-label for="year" value="Year" />
                    <x-select class="mt-1 block w-full" id="year" wire:model.live.debounce="selectedYear"
                        :default="'All Years'" :options="$years" />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3 lg:gap-8">
                @forelse ($posts as $post)
                    <x-card href="{{ route('show-post', ['slug' => $post->slug]) }}" wire:navigate
                        wire:key="{{ $post->id }}">
                        @if ($post->image_path)
                            <img class="aspect-video w-full rounded-sm object-cover" src="{{ $post->formattedImage() }}"
                                alt="{{ $post->title }}">
                        @else
                            <img class="aspect-video w-full rounded-sm object-cover"
                                src="{{ asset('images/logo.png') }}" alt="{{ $post->title }}">
                        @endif
                        <x-badge>
                            {{ $post->category->name }}
                        </x-badge>
                        <h4 class="text-xl font-semibold text-gray-950 group-hover:text-blue-800">
                            {{ $post->shortenedTitle() }}
                        </h4>
                        <p class="text-sm font-light text-gray-900">
                            {{ $post->shortenedContent() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-900">
                            {{ $post->formattedDate() }}
                        </p>
                    </x-card>
                @empty
                    <p class="text-base font-normal text-gray-900">
                        No news yet.
                    </p>
                @endforelse
            </div>

            <div class="pt-8">
                {{ $posts->links(data: ['scrollTo' => false]) }}
            </div>
        @else
            <div class="space-y-2 pb-8">
                <h2 class="text-3xl font-extrabold text-gray-950">
                    Search Results
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-3 lg:gap-8">
                @forelse ($posts as $post)
                    <x-card href="{{ route('show-post', ['slug' => $post->slug]) }}" wire:navigate
                        wire:key="{{ $post->id }}">
                        @if ($post->image_path)
                            <img class="aspect-video w-full rounded-sm object-cover"
                                src="{{ $post->formattedImage() }}" alt="{{ $post->title }}">
                        @else
                            <img class="aspect-video w-full rounded-sm object-cover"
                                src="{{ asset('images/logo.png') }}" alt="{{ $post->title }}">
                        @endif
                        <x-badge>
                            {{ $post->category->name }}
                        </x-badge>
                        <h4 class="text-xl font-semibold text-gray-950 group-hover:text-blue-800">
                            {{ $post->shortenedTitle() }}
                        </h4>
                        <p class="text-sm font-light text-gray-900">
                            {{ $post->shortenedContent() }}
                        </p>
                        <p class="text-xs font-extralight text-gray-900">
                            {{ $post->formattedDate() }}
                        </p>
                    </x-card>
                @empty
                    <p class="text-base font-normal text-gray-900">
                        No news found.
                    </p>
                @endforelse
            </div>

            <div class="pt-8">
                {{ $posts->links(data: ['scrollTo' => false]) }}
            </div>
        @endif
    </div>
</div>
