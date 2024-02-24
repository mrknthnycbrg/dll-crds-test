<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        Profile Information
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- First Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="first_name" value="First Name" />
            <x-input class="mt-1 block w-full" id="first_name" type="text" wire:model="state.first_name" required
                autocomplete="first_name" />
            <x-input-error class="mt-2" for="first_name" />
        </div>

        <!-- Middle Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="middle_name" value="Middle Name (Optional)" />
            <x-input class="mt-1 block w-full" id="middle_name" type="text" wire:model="state.middle_name"
                autocomplete="middle_name" />
            <x-input-error class="mt-2" for="middle_name" />
        </div>

        <!-- Last Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="last_name" value="Last Name" />
            <x-input class="mt-1 block w-full" id="last_name" type="text" wire:model="state.last_name" required
                autocomplete="last_name" />
            <x-input-error class="mt-2" for="last_name" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="Email" />
            <x-input class="mt-1 block w-full" id="email" type="email" wire:model="state.email" required
                autocomplete="username" />
            <x-input-error class="mt-2" for="email" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="mt-2 text-sm">
                    {{ __('Your email address is unverified.') }}

                    <button
                        class="rounded-md text-sm text-gray-700 underline hover:text-cyan-800 focus:outline-none focus:ring-2 focus:ring-cyan-800 focus:ring-offset-2"
                        type="button" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 text-sm font-medium text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            Saved.
        </x-action-message>

        <x-button wire:loading.attr="disabled">
            Save
        </x-button>
    </x-slot>
</x-form-section>
