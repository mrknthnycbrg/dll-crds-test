<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-logo class="size-28 block" href="{{ route('welcome') }}" role="button" wire:navigate />
        </x-slot>

        <div class="mb-4 text-sm text-gray-700">
            {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-center">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button type="submit">
                        Resend Verification Email
                    </x-button>
                </div>
            </form>
        </div>

        <div class="mt-4 flex items-center justify-around">
            <a class="rounded-md text-sm text-gray-700 underline hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2"
                href="{{ route('profile.show') }}" wire:navigate>
                Edit Profile
            </a>

            <form class="inline" method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="ml-2 rounded-md text-sm text-gray-700 underline hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2"
                    type="submit">
                    Log Out
                </button>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
