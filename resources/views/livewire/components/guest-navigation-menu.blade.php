<div>
    <nav class="border-b border-gray-200 bg-white" x-data="{ open: false }">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a class="group flex items-center space-x-2" href="{{ route('welcome') }}" wire:navigate>
                        <x-application-logo class="size-10 block" />
                        <span class="text-xl font-black text-black group-hover:text-blue-800 group-focus:text-blue-800">
                            {{ config('app.name', 'DLL-CRDS') }}
                        </span>
                    </a>
                </div>

                <div class="flex">
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('all-posts') }}" wire:navigate :active="request()->routeIs('all-posts')">
                            News
                        </x-nav-link>
                        @auth
                            <x-nav-link href="{{ route('home') }}" wire:navigate :active="request()->routeIs('home')">
                                Home
                            </x-nav-link>
                        @else
                            <x-nav-link href="{{ route('login') }}" wire:navigate :active="request()->routeIs('login')">
                                Log In
                            </x-nav-link>
                        @endauth
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-200 hover:text-blue-800 focus:bg-gray-200 focus:text-blue-800 focus:outline-none"
                        @click="open = ! open">
                        <x-hamburger-icon class="size-6 block" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div class="hidden sm:hidden" :class="{ 'block': open, 'hidden': !open }">
            <div class="space-y-1 pb-3 pt-2">
                <x-responsive-nav-link href="{{ route('all-posts') }}" wire:navigate :active="request()->routeIs('all-posts')">
                    News
                </x-responsive-nav-link>
                @auth
                    <x-responsive-nav-link href="{{ route('home') }}" wire:navigate :active="request()->routeIs('home')">
                        Home
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link href="{{ route('login') }}" wire:navigate :active="request()->routeIs('login')">
                        Log In
                    </x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </nav>
</div>
