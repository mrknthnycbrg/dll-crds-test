<div>
    <x-slot name="header">
        <h1 class="text-3xl font-black text-gray-900">
            Submit
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit.prevent="save">
            <div class="mb-4">
                <x-label for="email" value="Email" />
                <x-input class="mt-1 block w-full" id="email" name="email" type="email" wire:model="email" />
            </div>

            <div class="mb-4">
                <x-label for="file" value="File" />
                <x-file class="block w-full" id="file" name="file" type="file" wire:model="file" />
            </div>

            <x-button wire:target="save" wire:loading.attr="disabled">
                Submit
            </x-button>
        </form>
    </div>
</div>
