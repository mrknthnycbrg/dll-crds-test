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
                        <x-nav-link href="{{ route('home') }}" wire:navigate :active="request()->routeIs('home')">
                            Home
                        </x-nav-link>
                        <x-nav-link href="{{ route('all-researches') }}" wire:navigate :active="request()->routeIs('all-researches')">
                            Researches
                        </x-nav-link>
                        <x-nav-link href="{{ route('all-downloadables') }}" wire:navigate :active="request()->routeIs('all-downloadables')">
                            Resources
                        </x-nav-link>
                        <x-nav-link href="{{ route('collections') }}" wire:navigate :active="request()->routeIs('collections')">
                            Collections
                        </x-nav-link>
                        <x-nav-link href="{{ route('tools') }}" wire:navigate :active="request()->routeIs('tools')">
                            Tools
                        </x-nav-link>
                    </div>

                    <div class="hidden md:ms-4 md:flex md:items-center">
                        <!-- Settings Dropdown -->
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button
                                    class="flex rounded-full border-2 border-transparent text-sm text-gray-700 transition duration-150 ease-in-out hover:bg-gray-200 hover:text-blue-800 focus:bg-gray-200 focus:text-blue-800 focus:outline-none">
                                    <x-user-icon class="size-8 block" />
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-500">
                                    Manage Account
                                </div>
                                <x-dropdown-link href="{{ route('profile.show') }}" wire:navigate>
                                    Profile
                                </x-dropdown-link>
                                <div class="border-t border-gray-100">
                                </div>
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
                <x-responsive-nav-link href="{{ route('home') }}" wire:navigate :active="request()->routeIs('home')">
                    Home
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('all-researches') }}" wire:navigate :active="request()->routeIs('all-researches')">
                    Researches
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('all-downloadables') }}" wire:navigate :active="request()->routeIs('all-downloadables')">
                    Resources
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('collections') }}" wire:navigate :active="request()->routeIs('collections')">
                    Collections
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('tools') }}" wire:navigate :active="request()->routeIs('tools')">
                    Tools
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="border-t border-gray-100 pb-1 pt-4">
                <div class="flex items-center px-4">
                    <div>
                        <div class="text-base font-medium text-gray-700">
                            {{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}</div>
                        <div class="text-sm font-medium text-gray-500">
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
        </div>
    </nav>
</div>
