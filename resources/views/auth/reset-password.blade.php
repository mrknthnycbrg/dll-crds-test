<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-logo class="size-28 block" href="{{ route('welcome') }}" role="button" wire:navigate />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input name="token" type="hidden" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="Email" />
                <x-input class="mt-1 block w-full" id="email" name="email" type="email" :value="old('email', $request->email)"
                    required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="Password" />
                <x-input class="mt-1 block w-full" id="password" name="password" type="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="Confirm Password" />
                <x-input class="mt-1 block w-full" id="password_confirmation" name="password_confirmation"
                    type="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4 flex items-center justify-center">
                <x-button>
                    Reset Password
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
