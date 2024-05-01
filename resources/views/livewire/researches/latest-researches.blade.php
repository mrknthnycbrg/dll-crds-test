<div>
    @if ($latestResearches->isNotEmpty())
        <div class="mx-auto max-w-full px-4 py-8 sm:px-6 lg:px-8">
            <h1
                class="text-4xl font-black text-gray-900 underline decoration-yellow-400 decoration-4 underline-offset-8">
                Latest Researches
            </h1>

            @foreach ($departments as $department)
                <div class="flex items-center justify-between py-8" wire:key="{{ $department->id }}">
                    <a class="text-3xl font-extrabold text-gray-900 hover:text-blue-800"
                        href="{{ route('department-researches', ['slug' => $department->slug]) }}" wire:navigate>
                        {{ $department->name }} &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    @forelse ($latestResearches->where('department_id', $department->id) as $latestResearch)
                        <x-card href="{{ route('show-research', ['slug' => $latestResearch->slug]) }}" wire:navigate
                            wire:key="{{ $latestResearch->id }}">
                            <x-badge>
                                {{ optional($latestResearch->department)->name }}
                            </x-badge>
                            <h4 class="text-xl font-semibold text-gray-700 group-hover:text-blue-800">
                                {{ $latestResearch->title }}
                            </h4>
                            <p class="text-sm font-light text-gray-700">
                                {{ $latestResearch->formattedAbstract() }}
                            </p>
                            <p class="text-xs font-extralight text-gray-700">
                                {{ $latestResearch->formattedDate() }}
                            </p>
                        </x-card>
                    @empty
                        <p class="text-base font-normal text-gray-700">
                            No researches in this department yet.
                        </p>
                    @endforelse
                </div>
            @endforeach
        </div>
    @endif
</div>
