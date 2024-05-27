<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-logo class="size-28 block" href="{{ route('home') }}" role="button" wire:navigate />
        </x-slot>

        <div class="mb-4 text-sm text-gray-900">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @session('status')
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="Email" />
                <x-input class="mt-1 block w-full" id="email" name="email" type="email" :value="old('email')"
                    required autofocus autocomplete="username" />
            </div>

            <div class="mt-4 flex items-center justify-center">
                <x-button>
                    Email Password Reset Link
                </x-button>
            </div>

            <div class="mt-4 flex items-center justify-center">
                <a class="rounded-sm text-sm text-gray-900 underline hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2"
                    href="{{ route('login') }}" wire:navigate>
                    Remembered your password?
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-app-layout>
