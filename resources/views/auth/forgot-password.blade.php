<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-logo class="size-28 block" href="{{ route('welcome') }}" role="button" wire:navigate />
        </x-slot>

        <div class="mb-4 text-sm text-gray-700">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

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
        </form>
    </x-authentication-card>
</x-guest-layout>
