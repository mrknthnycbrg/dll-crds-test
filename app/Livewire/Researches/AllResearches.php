<?php

namespace App\Livewire\Researches;

use App\Models\Adviser;
use App\Models\Department;
use App\Models\Research;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AllResearches extends Component
{
    use WithPagination;

    public $selectedDepartment;

    public $selectedAdviser;

    public $selectedYear;

    public function render()
    {
        $departments = Department::pluck('name', 'id');

        $advisers = Adviser::pluck('name', 'id');

        $latestPublished = Research::where('published', true)->max('date_submitted');

        $earliestPublished = Research::where('published', true)->min('date_submitted');

        if ($latestPublished && $earliestPublished) {
            $latestYear = Carbon::parse($latestPublished)->year;
            $earliestYear = Carbon::parse($earliestPublished)->year;

            $yearRange = range($latestYear, $earliestYear);
            $years = array_combine($yearRange, $yearRange);
        } else {
            $years = null;
        }

        $researches = Research::with(['department', 'adviser'])
            ->where('published', true)
            ->when($this->selectedDepartment, function ($query) {
                $query->where('department_id', $this->selectedDepartment);
            })
            ->when($this->selectedAdviser, function ($query) {
                $query->where('adviser_id', $this->selectedAdviser);
            })
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('date_submitted', $this->selectedYear);
            })
            ->latest('date_submitted')
            ->paginate(6);

        return view('livewire.researches.all-researches', compact('researches', 'departments', 'advisers', 'years'))
            ->layout('layouts.app')
            ->title('Researches - DLL-CRDS');
    }

    public function updatedSelectedDepartment()
    {
        $this->resetPage();
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
