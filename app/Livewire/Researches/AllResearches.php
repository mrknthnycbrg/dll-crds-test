<?php

namespace App\Livewire\Researches;

use App\Models\Adviser;
use App\Models\Department;
use App\Models\Research;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AllResearches extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    public $selectedDepartment;

    public $selectedAdviser;

    public $selectedYear;

    public function render()
    {
        if (empty($this->search)) {
            $departmentsQuery = Department::whereHas('researches', function ($query) {
                $query->when($this->selectedAdviser, function ($query) {
                    $query->where('adviser_id', $this->selectedAdviser);
                })->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_submitted', $this->selectedYear);
                });
            });

            $departments = $departmentsQuery->pluck('name', 'id');

            $advisersQuery = Adviser::whereHas('researches', function ($query) {
                $query->when($this->selectedDepartment, function ($query) {
                    $query->where('department_id', $this->selectedDepartment);
                })->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_submitted', $this->selectedYear);
                });
            });

            $advisers = $advisersQuery->pluck('name', 'id');

            $latestPublished = Research::where('published', true)
                ->when($this->selectedDepartment, function ($query) {
                    $query->where('department_id', $this->selectedDepartment);
                })
                ->when($this->selectedAdviser, function ($query) {
                    $query->where('adviser_id', $this->selectedAdviser);
                })
                ->max('date_submitted');

            $earliestPublished = Research::where('published', true)
                ->when($this->selectedDepartment, function ($query) {
                    $query->where('department_id', $this->selectedDepartment);
                })
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
                ->paginate(12);
        } else {
            $researches = Research::search(trim($this->search))
                ->query(function ($query) {
                    $query->leftJoin('departments', 'researches.department_id', '=', 'departments.id')
                        ->leftJoin('advisers', 'researches.adviser_id', '=', 'advisers.id')
                        ->leftJoin('year_sections', 'researches.year_section_id', '=', 'year_sections.id')
                        ->select(
                            'researches.*',
                            'departments.abbreviation as department_abbreviation',
                            'departments.name as department_name',
                        )
                        ->with('department')
                        ->where('published', true)
                        ->latest('date_submitted');
                })
                ->paginate(12);

            return view('livewire.researches.all-researches', compact('researches'));
        }

        return view('livewire.researches.all-researches', compact('researches', 'departments', 'advisers', 'years'))
            ->title('All Researches - DLL-CRDS');
    }

    public function updatedSearch()
    {
        $this->resetPage();
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
