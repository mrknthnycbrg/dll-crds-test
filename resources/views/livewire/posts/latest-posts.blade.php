<div class="relative" data-hs-carousel='{"loadingClasses": "opacity-0","isAutoPlay": true}'>
    <div class="hs-carousel relative min-h-[500px] w-full overflow-hidden bg-white">
        <div
            class="hs-carousel-body absolute bottom-0 start-0 top-0 flex flex-nowrap opacity-0 transition-transform duration-700">
            @forelse ($latestPosts as $post)
                <a class="hs-carousel-slide group" href="{{ route('show-post', ['slug' => $post->slug]) }}" wire:navigate
                    wire:key="{{ $post->id }}">
                    <div class="flex h-full flex-col justify-end"
                        style="background-image: url('{{ $post->image_path ? $post->formattedImage() : asset('images/logo.png') }}'); background-size: cover; background-position: center;">
                        <div class="space-y-2 bg-blue-900 bg-opacity-50 p-6 text-left backdrop-blur-md">
                            <h1 class="text-4xl font-black text-yellow-400">
                                {{ $post->title }}
                            </h1>
                            <p class="text-base font-normal text-gray-100">
                                {{ $post->formattedContent() }}
                            </p>
                            <p class="text-sm font-light text-gray-100">
                                {{ $post->formattedDate() }}
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="hs-carousel-slide">
                    <div class="flex h-full flex-col justify-end"
                        style="background-image: url('{{ asset('images/featured.png') }}'); background-size: cover; background-position: center;">
                        <div class="space-y-2 bg-blue-900 bg-opacity-50 p-6 text-left backdrop-blur-md">
                            <h1 class="text-4xl font-black text-yellow-400">
                                College Research and Development Services
                            </h1>
                            <h2 class="text-3xl font-extrabold text-gray-100">
                                Dalubhasaan ng Lungsod ng Lucena
                            </h2>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @if ($latestPosts->count() > 1)
        <button
            class="hs-carousel-prev hs-carousel:disabled:opacity-50 absolute inset-y-0 start-0 inline-flex h-full w-[46px] items-center justify-center text-gray-400 hover:bg-gray-900/[.1] disabled:pointer-events-none"
            type="button">
            <span class="text-2xl" aria-hidden="true">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                </svg>
            </span>
            <span class="sr-only">
                Previous
            </span>
        </button>
        <button
            class="hs-carousel-next hs-carousel:disabled:opacity-50 absolute inset-y-0 end-0 inline-flex h-full w-[46px] items-center justify-center text-gray-400 hover:bg-gray-900/[.1] disabled:pointer-events-none"
            type="button">
            <span class="sr-only">
                Next
            </span>
            <span class="text-2xl" aria-hidden="true">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </span>
        </button>

        <div class="hs-carousel-pagination absolute bottom-3 end-0 start-0 flex justify-center space-x-2">
            @foreach ($latestPosts as $post)
                <span
                    class="size-3 cursor-pointer rounded-full border border-gray-400 hs-carousel-active:border-yellow-400 hs-carousel-active:bg-yellow-400">
                </span>
            @endforeach
        </div>
    @endif
</div>
