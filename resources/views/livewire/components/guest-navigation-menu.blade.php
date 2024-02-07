<div class="sticky inset-x-0 top-0 z-50 shadow-md">
    <nav class="bg-white" x-data="{ open: false }">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <!-- Logo -->
                <div class="flex shrink-0">
                    <a class="group flex items-center space-x-4" href="{{ route('welcome') }}" wire:navigate>
                        <x-application-logo class="size-10 block" />
                        <div class="flex flex-col">
                            <p
                                class="block border-b border-gray-900 text-base font-black text-gray-900 group-hover:text-blue-800 group-focus:text-blue-800">
                                College Research and Development Services
                            </p>
                            <p
                                class="block text-sm font-bold text-gray-900 group-hover:text-blue-800 group-focus:text-blue-800">
                                Dalubhasaan ng Lungsod ng Lucena
                            </p>
                        </div>
                    </a>
                </div>

                <div class="flex">
                    <!-- Navigation Links -->
                    <div class="hidden space-x-4 md:-my-px md:ms-4 md:flex">
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
                <div class="-me-2 flex items-center md:hidden">
                    <button
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-200 hover:text-blue-800 focus:bg-gray-200 focus:text-blue-800 focus:outline-none"
                        @click="open = ! open">
                        <x-hamburger-icon class="size-6 block" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div class="hidden md:hidden" :class="{ 'block': open, 'hidden': !open }">
            <div class="space-y-1 pb-3 pt-2">
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
