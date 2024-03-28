<div class="relative" data-hs-carousel='{"loadingClasses": "opacity-0","isAutoPlay": true}'>
    <div class="hs-carousel relative min-h-[500px] w-full overflow-hidden bg-white">
        <div
            class="hs-carousel-body absolute bottom-0 start-0 top-0 flex flex-nowrap opacity-0 transition-transform duration-700">
            @forelse ($latestPosts as $latestPost)
                <a class="hs-carousel-slide group" href="{{ route('show-post', ['slug' => $latestPost->slug]) }}"
                    wire:navigate wire:key="{{ $latestPost->id }}">
                    <div class="flex h-full justify-start"
                        style="background-image: url('{{ $latestPost->image_path ? $latestPost->formattedImage() : asset('images/featured.png') }}'); background-size: cover; background-position: center;">
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                            <div class="space-y-2 bg-blue-800 bg-opacity-50 p-4 text-left backdrop-blur-md">
                                <h1 class="text-4xl font-black text-yellow-400">
                                    {{ $latestPost->title }}
                                </h1>
                                <p class="text-base font-normal text-gray-100">
                                    {{ $latestPost->formattedContent() }}
                                </p>
                                <p class="text-sm font-light text-gray-100">
                                    {{ $latestPost->formattedDate() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="hs-carousel-slide">
                    <div class="flex h-full justify-start"
                        style="background-image: url('{{ asset('images/featured.png') }}'); background-size: cover; background-position: center;">
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                            <div class="space-y-2 bg-blue-800 bg-opacity-50 p-4 text-left backdrop-blur-md">
                                <h1 class="text-4xl font-black text-yellow-400">
                                    College Research and Development Services
                                </h1>
                                <h2 class="text-3xl font-extrabold text-gray-100">
                                    Dalubhasaan ng Lungsod ng Lucena
                                </h2>
                                <div class="flex items-center justify-center py-2">
                                    <x-application-logo class="size-64" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @if ($latestPosts->count() > 1)
        <div class="hs-carousel-pagination absolute bottom-3 end-0 start-0 flex justify-center space-x-2">
            @foreach ($latestPosts as $latestPost)
                <span
                    class="size-3 cursor-pointer rounded-sm border border-gray-400 hs-carousel-active:border-yellow-400 hs-carousel-active:bg-yellow-400">
                </span>
            @endforeach
        </div>
    @endif
</div>
