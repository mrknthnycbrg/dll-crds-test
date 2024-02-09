<?php

namespace App\Livewire\Researches;

use App\Models\Adviser;
use App\Models\Department;
use App\Models\Research;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentResearches extends Component
{
    use WithPagination;

    public $department;

    public $selectedAdviser;

    public $selectedYear;

    public function mount($slug)
    {
        $this->department = Department::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $advisersQuery = Adviser::whereHas('researches', function ($query) {
            $query->where('department_id', $this->department->id);
        })->when($this->selectedYear, function ($query) {
            $query->whereYear('date_submitted', $this->selectedYear);
        });

        $advisers = $advisersQuery->pluck('name', 'id');

        $latestPublished = Research::where('published', true)
            ->where('department_id', $this->department->id)
            ->when($this->selectedAdviser, function ($query) {
                $query->where('adviser_id', $this->selectedAdviser);
            })
            ->max('date_submitted');

        $earliestPublished = Research::where('published', true)
            ->where('department_id', $this->department->id)
            ->when($this->selectedAdviser, function ($query) {
                $query->where('adviser_id', $this->selectedAdviser);
            })
            ->min('date_submitted');

        if ($latestPublished && $earliestPublished) {
            $latestYear = Carbon::parse($latestPublished)->year;
            $earliestYear = Carbon::parse($earliestPublished)->year;

            $yearRange = range($latestYear, $earliestYear);
            $years = array_combine($yearRange, $yearRange);
        } else {
            $years = null;
        }

        $researches = Research::with('department')
            ->where('department_id', $this->department->id)
            ->where('published', true)
            ->when($this->selectedAdviser, function ($query) {
                $query->where('adviser_id', $this->selectedAdviser);
            })
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('date_submitted', $this->selectedYear);
            })
            ->latest('date_submitted')
            ->paginate(6);

        return view('livewire.researches.department-researches', compact('researches', 'advisers', 'years'))
            ->layout('layouts.app')
            ->title($this->department->name.' - DLL-CRDS');
    }

    public function updatedSelectedAdviser()
    {
        $this->resetPage();
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}