@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="bg-gray-50 text-lg font-medium text-gray-950">
            {{ $title }}
        </div>

        <div class="mt-4 bg-gray-50 text-sm text-gray-900">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end bg-gray-50 px-6 py-4 text-right">
        {{ $footer }}
    </div>
</x-modal>
