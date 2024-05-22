<nav class="sticky inset-x-0 top-0 z-50 flex w-full flex-wrap bg-gray-50 py-2 shadow-sm lg:flex-nowrap lg:justify-start">
    <div class="relative mx-auto w-full max-w-7xl px-4 sm:px-6 lg:flex lg:items-center lg:justify-between lg:px-8">
        <div class="flex items-center justify-between">
            <a class="group inline-flex items-center gap-x-2" href="{{ route('home') }}" wire:navigate>
                <x-application-logo class="size-14" />
                <div class="flex flex-col whitespace-nowrap">
                    <p class="text-base font-black text-blue-800">
                        College Research and Development Services
                    </p>
                    <hr class="border-blue-800">
                    <p class="text-sm font-extrabold text-gray-900">
                        Dalubhasaan ng Lungsod ng Lucena
                    </p>
                </div>
            </a>

            <div class="lg:hidden">
                <x-hamburger-menu />
            </div>
        </div>
        <div class="hs-collapse hidden grow basis-full overflow-hidden transition-all duration-300 lg:block"
            id="navbar">
            <div
                class="mt-5 flex flex-col gap-x-0 gap-y-4 lg:mt-0 lg:flex-row lg:items-center lg:justify-end lg:gap-x-7 lg:gap-y-0 lg:ps-7">
                <div class="hs-dropdown [--adaptive:none] [--strategy:static] lg:py-4 lg:[--strategy:fixed]">
                    <x-nav-button :active="request()->routeIs(['about', 'contact'])">
                        About
                    </x-nav-button>

                    <div
                        class="hs-dropdown-menu lg: top-full z-10 hidden rounded-sm bg-gray-50 p-2 opacity-0 transition-[opacity,margin] duration-[0.1ms] before:absolute before:-top-5 before:start-0 before:h-5 before:w-full hs-dropdown-open:opacity-100 lg:max-h-[75vh] lg:w-48 lg:overflow-y-auto lg:duration-[150ms]">
                        <x-dropdown-link href="{{ route('about') }}" wire:navigate>
                            About Us
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('contact') }}" wire:navigate>
                            Contact Us
                        </x-dropdown-link>
                    </div>
                </div>

                <div class="hs-dropdown [--adaptive:none] [--strategy:static] lg:py-4 lg:[--strategy:fixed]">
                    <x-nav-button :active="request()->routeIs(['all-posts', 'category-posts', 'show-post'])">
                        News
                    </x-nav-button>

                    <div
                        class="hs-dropdown-menu lg: top-full z-10 hidden rounded-sm bg-gray-50 p-2 opacity-0 transition-[opacity,margin] duration-[0.1ms] before:absolute before:-top-5 before:start-0 before:h-5 before:w-full hs-dropdown-open:opacity-100 lg:max-h-[75vh] lg:w-48 lg:overflow-y-auto lg:duration-[150ms]">
                        <x-dropdown-link href="{{ route('all-posts') }}" wire:navigate>
                            All News
                        </x-dropdown-link>
                        @foreach ($categories as $category)
                            <x-dropdown-link href="{{ route('category-posts', ['slug' => $category->slug]) }}"
                                wire:navigate wire:key="{{ $category->id }}">
                                {{ $category->name }}
                            </x-dropdown-link>
                        @endforeach
                    </div>
                </div>

                <div class="hs-dropdown [--adaptive:none] [--strategy:static] lg:py-4 lg:[--strategy:fixed]">
                    <x-nav-button :active="request()->routeIs(['all-researches', 'department-researches', 'show-research'])">
                        Researches
                    </x-nav-button>

                    <div
                        class="hs-dropdown-menu lg: top-full z-10 hidden rounded-sm bg-gray-50 p-2 opacity-0 transition-[opacity,margin] duration-[0.1ms] before:absolute before:-top-5 before:start-0 before:h-5 before:w-full hs-dropdown-open:opacity-100 lg:max-h-[75vh] lg:w-48 lg:overflow-y-auto lg:duration-[150ms]">
                        <x-dropdown-link href="{{ route('all-researches') }}" wire:navigate>
                            All Researches
                        </x-dropdown-link>
                        @foreach ($departments as $department)
                            <x-dropdown-link href="{{ route('department-researches', ['slug' => $department->slug]) }}"
                                wire:navigate wire:key="{{ $department->id }}">
                                {{ $department->name }}
                            </x-dropdown-link>
                        @endforeach
                    </div>
                </div>

                <x-nav-link href="{{ route('all-downloadables') }}" wire:navigate :active="request()->routeIs(['all-downloadables', 'show-downloadable'])">
                    Resources
                </x-nav-link>

                @auth
                    <x-nav-link href="{{ route('tools') }}" wire:navigate :active="request()->routeIs('tools')">
                        Tools
                    </x-nav-link>

                    <div class="hs-dropdown [--adaptive:none] [--strategy:static] lg:py-4 lg:[--strategy:fixed]">
                        <x-nav-button :active="request()->routeIs('profile.show')">
                            Profile
                        </x-nav-button>

                        <div
                            class="hs-dropdown-menu lg: top-full z-10 hidden rounded-sm bg-gray-50 p-2 opacity-0 transition-[opacity,margin] duration-[0.1ms] before:absolute before:-top-5 before:start-0 before:h-5 before:w-full hs-dropdown-open:opacity-100 lg:max-h-[75vh] lg:w-48 lg:overflow-y-auto lg:duration-[150ms]">
                            <x-dropdown-link href="{{ route('profile.show') }}" wire:navigate>
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                @else
                    <x-nav-link href="{{ route('login') }}" wire:navigate :active="request()->routeIs('login')">
                        Log In
                    </x-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>
