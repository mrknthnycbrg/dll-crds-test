<div>
    <x-slot name="header">
        <h1 class="text-3xl font-black text-gray-900">
            Collections
        </h1>
    </x-slot>

    <div class="mx-auto max-w-full px-4 pb-8 sm:px-6 lg:px-8">
        @forelse ($departments as $department)
            <div class="flex items-center justify-between space-y-2 py-8">
                <h2 class="text-2xl font-black text-gray-900">
                    {{ $department->name }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-8">
                @forelse ($department->researches as $research)
                    <x-card href="{{ route('show-research', ['slug' => $research->slug]) }}" wire:navigate
                        wire:key="{{ $research->id }}">
                        <h3 class="text-base font-bold text-gray-700 group-hover:text-blue-800">
                            {{ $research->title }}
                        </h3>
                        <p class="text-xs font-thin text-gray-700">
                            {{ $research->formattedDate() }}
                        </p>
                    </x-card>
                @empty
                    <p class="text-lg font-bold text-gray-700">
                        No researches in this department yet.
                    </p>
                @endforelse
            </div>
        @empty
            <p class="text-lg font-bold text-gray-700">
                No departments with researches yet.
            </p>
        @endforelse
    </div>
</div>
