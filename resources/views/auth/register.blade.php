<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-logo class="size-28 block" href="{{ route('home') }}" role="button" wire:navigate />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="id_number" value="Student Number" />
                <x-input class="mt-1 block w-full" id="id_number" name="id_number" type="text" :value="old('id_number')"
                    required autofocus autocomplete="id_number" />
            </div>

            <div>
                <x-label for="first_name" value="First Name" />
                <x-input class="mt-1 block w-full" id="first_name" name="first_name" type="text" :value="old('first_name')"
                    required autocomplete="first_name" />
            </div>

            <div>
                <x-label for="middle_name" value="Middle Name (Optional)" />
                <x-input class="mt-1 block w-full" id="middle_name" name="middle_name" type="text" :value="old('middle_name')"
                    autocomplete="middle_name" />
            </div>

            <div>
                <x-label for="last_name" value="Last Name" />
                <x-input class="mt-1 block w-full" id="last_name" name="last_name" type="text" :value="old('last_name')"
                    required autocomplete="last_name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="Email" />
                <x-input class="mt-1 block w-full" id="email" name="email" type="email" :value="old('email')"
                    required autocomplete="username" />
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
                    Register
                </x-button>
            </div>

            <div class="mt-4 flex items-center justify-center">
                <a class="rounded-sm text-sm text-gray-900 underline hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2"
                    href="{{ route('login') }}" wire:navigate>
                    Already registered?
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-app-layout>
