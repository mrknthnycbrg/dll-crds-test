<x-form-section submit="updatePassword">
    <x-slot name="title">
        Update Password
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="Current Password" />
            <x-input class="mt-1 block w-full" id="current_password" type="password" wire:model="state.current_password"
                autocomplete="current-password" />
            <x-input-error class="mt-2" for="current_password" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="New Password" />
            <x-input class="mt-1 block w-full" id="password" type="password" wire:model="state.password"
                autocomplete="new-password" />
            <x-input-error class="mt-2" for="password" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="Confirm Password" />
            <x-input class="mt-1 block w-full" id="password_confirmation" type="password"
                wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error class="mt-2" for="password_confirmation" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            Saved.
        </x-action-message>

        <x-button>
            Save
        </x-button>
    </x-slot>
</x-form-section>
