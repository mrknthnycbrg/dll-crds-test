<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-logo class="size-28 block" href="{{ route('welcome') }}" role="button" wire:navigate />
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-gray-700" x-show="! recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </div>

            <div class="mb-4 text-sm text-gray-700" x-cloak x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-label for="code" value="Code" />
                    <x-input class="mt-1 block w-full" id="code" name="code" type="text" inputmode="numeric"
                        autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4" x-cloak x-show="recovery">
                    <x-label for="recovery_code" value="Recovery Code" />
                    <x-input class="mt-1 block w-full" id="recovery_code" name="recovery_code" type="text"
                        x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <button class="cursor-pointer text-sm text-gray-700 underline hover:text-blue-800" type="button"
                        x-show="! recovery"
                        x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Use a recovery code') }}
                    </button>

                    <button class="cursor-pointer text-sm text-gray-700 underline hover:text-blue-800" type="button"
                        x-cloak x-show="recovery"
                        x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Use an authentication code') }}
                    </button>

                    <x-button class="ml-4">
                        Log in
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
