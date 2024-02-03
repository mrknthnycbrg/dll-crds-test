<?php

namespace App\Livewire\Downloadables;

use App\Models\Downloadable;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AllDownloadables extends Component
{
    use WithPagination;

    public $selectedYear;

    public function render()
    {
        $latestPublished = Downloadable::where('published', true)->max('date_published');

        $earliestPublished = Downloadable::where('published', true)->min('date_published');

        if ($latestPublished && $earliestPublished) {
            $latestYear = Carbon::parse($latestPublished)->year;
            $earliestYear = Carbon::parse($earliestPublished)->year;

            $yearRange = range($latestYear, $earliestYear);
            $years = array_combine($yearRange, $yearRange);
        } else {
            $years = null;
        }

        $downloadables = Downloadable::where('published', true)
            ->latest('date_published')
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('date_published', $this->selectedYear);
            })
            ->paginate(6);

        return view('livewire.downloadables.all-downloadables', compact('downloadables', 'years'))
            ->layout('layouts.app')
            ->title('Resources - DLL-CRDS');
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}
