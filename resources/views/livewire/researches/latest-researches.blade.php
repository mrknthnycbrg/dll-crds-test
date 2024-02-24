<div class="mx-auto max-w-full bg-gray-100 px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between space-y-2">
        <h1 class="text-3xl font-black text-gray-900">
            Latest Researches
        </h1>
    </div>

    @forelse ($departments as $department)
        <div class="flex items-center justify-between space-y-2 py-8">
            <h2 class="text-2xl font-black text-gray-900">
                {{ $department->name }}
            </h2>

            @if ($department->researches->isNotEmpty())
                <a class="text-lg font-bold text-gray-700 hover:text-cyan-800"
                    href="{{ route('department-researches', ['slug' => $department->slug]) }}" wire:navigate>
                    View all &rarr;
                </a>
            @endif
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            @forelse ($researches->where('department_id', $department->id) as $research)
                <x-card href="{{ route('show-research', ['slug' => $research->slug]) }}" wire:navigate
                    wire:key="{{ $research->id }}">
                    @if ($research->image_path)
                        <img class="mx-auto aspect-video w-full rounded-md object-cover"
                            src="{{ $research->formattedImage() }}" alt="{{ $research->title }}">
                    @endif
                    <div class="pt-4">
                        <h3 class="text-base font-bold text-gray-700 group-hover:text-cyan-800">
                            {{ $research->title }}
                        </h3>
                        <p class="text-sm font-medium text-gray-700">
                            {{ optional($research->department)->name }}
                        </p>
                        <p class="text-sm font-light text-gray-700">
                            {{ $research->formattedAbstract() }}
                        </p>
                        <p class="text-xs font-thin text-gray-700">
                            {{ $research->formattedDate() }}
                        </p>
                    </div>
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
