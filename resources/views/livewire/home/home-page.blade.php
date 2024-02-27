<div class="bg-cover bg-fixed bg-left bg-no-repeat" style="background-image: url({{ asset('images/featured.png') }})">
    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 items-center gap-8 lg:grid-cols-2">
            <div class="col-span-1 rounded-md bg-cyan-800 bg-opacity-50 p-8 backdrop-blur-sm backdrop-brightness-50">
                <div class="my-4 space-y-4">
                    <h1 class="block text-4xl font-black text-amber-400 md:text-6xl">
                        College Research and Development Services
                    </h1>
                    <p class="text-2xl font-bold text-gray-100 md:text-4xl">
                        Dalubhasaan ng Lungsod ng Lucena
                    </p>
                </div>
            </div>
        </div>
    </div>
    <hr class="border-2 border-amber-400">
    <livewire:posts.latest-posts />

    @auth
        <hr class="border-2 border-amber-400">
        <livewire:researches.latest-researches />
    @endauth

    <div class="mx-auto max-w-full bg-gray-200 px-4 py-8 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-sm text-gray-700">
                &copy; {{ date('Y') }} {{ config('app.name', 'DLL-CRDS') }}. All rights reserved.
            </p>
        </div>
    </div>
</div>
