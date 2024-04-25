<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-logo class="size-28 block" href="{{ route('home') }}" role="button" wire:navigate />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="Email" />
                <x-input class="mt-1 block w-full" id="email" name="email" type="email" :value="old('email')"
                    required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="Password" />
                <x-input class="mt-1 block w-full" id="password" name="password" type="password" required
                    autocomplete="current-password" />
            </div>

            <div class="mt-4 flex items-center justify-between">
                <label class="flex items-center" for="remember_me">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-700">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="rounded-sm text-sm text-gray-700 underline hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2"
                        href="{{ route('password.request') }}" wire:navigate>
                        Forgot your password?
                    </a>
                @endif
            </div>

            <div class="mt-4 flex items-center justify-center">
                <x-button>
                    Log in
                </x-button>
            </div>

            <div class="mt-4 flex items-center justify-center">
                <a class="rounded-sm text-sm text-gray-700 underline hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2"
                    href="{{ route('register') }}" wire:navigate>
                    Not yet registered?
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-app-layout>
