<div class="sticky inset-x-0 top-0 z-50 shadow-md">
    <nav class="bg-blue-800" x-data="{ open: false }">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <!-- Logo -->
                <div class="flex shrink-0">
                    <a class="group flex items-center space-x-4" href="{{ route('home') }}" wire:navigate>
                        <x-application-logo class="size-10 block" />
                        <div class="flex flex-col">
                            <p class="block text-base font-black text-yellow-400">
                                College Research and Development Services
                            </p>
                            <hr class="border-yellow-400">
                            <p class="block text-sm font-thin text-gray-50">
                                Dalubhasaan ng Lungsod ng Lucena
                            </p>
                        </div>
                    </a>
                </div>

                <div class="flex">
                    <!-- Navigation Links -->
                    <div class="hidden space-x-4 lg:-my-px lg:ms-4 lg:flex">
                        <x-nav-link href="{{ route('all-posts') }}" wire:navigate :active="request()->routeIs(['all-posts', 'show-post'])">
                            News
                        </x-nav-link>
                        <x-nav-link href="{{ route('all-researches') }}" wire:navigate :active="request()->routeIs(['all-researches', 'department-researches', 'show-research'])">
                            Researches
                        </x-nav-link>
                        <x-nav-link href="{{ route('all-downloadables') }}" wire:navigate :active="request()->routeIs(['all-downloadables', 'show-downloadable'])">
                            Resources
                        </x-nav-link>

                        @auth
                            <x-nav-link href="{{ route('tools') }}" wire:navigate :active="request()->routeIs('tools')">
                                Tools
                            </x-nav-link>
                            <x-nav-link href="{{ route('submit') }}" wire:navigate :active="request()->routeIs('submit')">
                                Submit
                            </x-nav-link>
                        @else
                            <x-nav-link href="{{ route('login') }}" wire:navigate :active="request()->routeIs('login')">
                                Log In
                            </x-nav-link>
                        @endauth
                    </div>

                    @auth
                        <div class="hidden lg:ms-4 lg:flex lg:items-center">
                            <!-- Settings Dropdown -->
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button
                                        class="flex rounded-full border-2 border-transparent text-sm text-gray-50 transition duration-150 ease-in-out hover:bg-blue-900 hover:text-yellow-400 focus:bg-blue-900 focus:text-yellow-400 focus:outline-none">
                                        <x-user-icon class="size-8 block" />
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-200">
                                        Manage Account
                                    </div>
                                    <x-dropdown-link href="{{ route('profile.show') }}" wire:navigate>
                                        Profile
                                    </x-dropdown-link>
                                    <hr class="border-yellow-400">
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            Log Out
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endauth
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center lg:hidden">
                    <button
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-50 transition duration-150 ease-in-out hover:bg-blue-900 hover:text-yellow-400 focus:bg-blue-900 focus:text-yellow-400 focus:outline-none"
                        @click="open = ! open">
                        <x-hamburger-icon class="size-6 block" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div class="hidden lg:hidden" :class="{ 'block': open, 'hidden': !open }">
            <div class="space-y-1 pb-3 pt-2">
                <x-responsive-nav-link href="{{ route('all-posts') }}" wire:navigate :active="request()->routeIs(['all-posts', 'show-post'])">
                    News
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('all-researches') }}" wire:navigate :active="request()->routeIs(['all-researches', 'department-researches', 'show-research'])">
                    Researches
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('all-downloadables') }}" wire:navigate :active="request()->routeIs(['all-downloadables', 'show-downloadable'])">
                    Resources
                </x-responsive-nav-link>

                @auth
                    <x-responsive-nav-link href="{{ route('tools') }}" wire:navigate :active="request()->routeIs('tools')">
                        Tools
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('submit') }}" wire:navigate :active="request()->routeIs('submit')">
                        Submit
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link href="{{ route('login') }}" wire:navigate :active="request()->routeIs('login')">
                        Log In
                    </x-responsive-nav-link>
                @endauth
            </div>

            <!-- Responsive Settings Options -->
            @auth
                <hr class="border-yellow-400">
                <div class="pb-1 pt-4">
                    <div class="flex items-center px-4">
                        <div>
                            <div class="text-sm font-medium text-gray-200">
                                {{ Auth::user()->first_name }}
                                {{ Auth::user()->last_name }}
                            </div>
                            <div class="text-sm font-medium text-gray-200">
                                {{ Auth::user()->email }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-responsive-nav-link href="{{ route('profile.show') }}" wire:navigate :active="request()->routeIs('profile.show')">
                            Profile
                        </x-responsive-nav-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                Log Out
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </nav>
</div>
