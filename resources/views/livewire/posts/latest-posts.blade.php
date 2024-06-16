<div class="relative" data-hs-carousel='{"loadingClasses": "opacity-0","isAutoPlay": true}'>
    @if ($latestPosts->isNotEmpty())
        <div class="hs-carousel relative min-h-[75vh] w-full overflow-hidden bg-gray-50">
            <div
                class="hs-carousel-body absolute bottom-0 start-0 top-0 flex flex-nowrap opacity-0 transition-transform duration-700">
                @foreach ($latestPosts as $latestPost)
                    <a class="hs-carousel-slide group" href="{{ route('show-post', ['slug' => $latestPost->slug]) }}"
                        wire:navigate wire:key="{{ $latestPost->id }}">
                        <div class="flex h-full"
                            style="background-image: url('{{ $latestPost->image_path ? $latestPost->formattedImage() : asset('images/logo.png') }}'); background-size: cover; background-position: center;">
                            <div class="flex w-full flex-col-reverse">
                                <div class="bg-brightness-75 bg-blue-800 bg-opacity-75 backdrop-blur">
                                    <div class="mx-auto max-w-7xl space-y-2 px-4 py-8 text-left sm:px-6 lg:px-8">
                                        <x-badge>
                                            {{ $latestPost->category->name }}
                                        </x-badge>
                                        <h1 class="text-4xl font-black text-gray-50 group-hover:text-yellow-400">
                                            {{ $latestPost->shortenedTitle() }}
                                        </h1>
                                        <p class="text-base font-normal text-gray-100">
                                            {{ $latestPost->shortenedContent() }}
                                        </p>
                                        <p class="text-sm font-light text-gray-100">
                                            {{ $latestPost->formattedDate() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        @if ($latestPosts->count() > 1)
            <div class="hs-carousel-pagination absolute bottom-3 end-0 start-0 flex justify-center space-x-2">
                @foreach ($latestPosts as $latestPost)
                    <span
                        class="size-3 cursor-pointer rounded-sm border border-gray-100 hs-carousel-active:border-gray-50 hs-carousel-active:bg-gray-50">
                    </span>
                @endforeach
            </div>
        @endif

    @endif
</div>
