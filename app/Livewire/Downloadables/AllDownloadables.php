<?php

namespace App\Livewire\Downloadables;

use App\Models\Downloadable;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AllDownloadables extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    public $selectedYear;

    public function render()
    {
        if (empty($this->search)) {
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
                ->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_published', $this->selectedYear);
                })
                ->latest('date_published')
                ->paginate(12);
        } else {
            $downloadables = Downloadable::search(trim($this->search))
                ->query(function ($query) {
                    $query->leftJoin('authors', 'downloadables.author_id', '=', 'authors.id')
                        ->where('published', true)
                        ->latest('date_published');
                })
                ->paginate(12);

            return view('livewire.downloadables.all-downloadables', compact('downloadables'));
        }

        return view('livewire.downloadables.all-downloadables', compact('downloadables', 'years'))
            ->title('Resources - DLL-CRDS');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}
