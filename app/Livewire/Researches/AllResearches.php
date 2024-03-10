<?php

namespace App\Livewire\Researches;

use App\Models\Adviser;
use App\Models\Award;
use App\Models\Category;
use App\Models\Client;
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

    public $selectedCategory;

    public $selectedClient;

    public $selectedAward;

    public $selectedYear;

    public function render()
    {
        if (empty($this->search)) {
            $departmentsQuery = Department::whereHas('researches', function ($query) {
                $query->when($this->selectedAdviser, function ($query) {
                    $query->where('adviser_id', $this->selectedAdviser);
                })->when($this->selectedCategory, function ($query) {
                    $query->where('category_id', $this->selectedCategory);
                })->when($this->selectedClient, function ($query) {
                    $query->where('client_id', $this->selectedClient);
                })->when($this->selectedAward, function ($query) {
                    $query->where('award_id', $this->selectedAward);
                })->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_submitted', $this->selectedYear);
                });
            });

            $departments = $departmentsQuery->pluck('name', 'id');

            $advisersQuery = Adviser::whereHas('researches', function ($query) {
                $query->when($this->selectedDepartment, function ($query) {
                    $query->where('department_id', $this->selectedDepartment);
                })->when($this->selectedCategory, function ($query) {
                    $query->where('category_id', $this->selectedCategory);
                })->when($this->selectedClient, function ($query) {
                    $query->where('client_id', $this->selectedClient);
                })->when($this->selectedAward, function ($query) {
                    $query->where('award_id', $this->selectedAward);
                })->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_submitted', $this->selectedYear);
                });
            });

            $advisers = $advisersQuery->pluck('name', 'id');

            $categoriesQuery = Category::whereHas('researches', function ($query) {
                $query->when($this->selectedDepartment, function ($query) {
                    $query->where('department_id', $this->selectedDepartment);
                })->when($this->selectedAdviser, function ($query) {
                    $query->where('adviser_id', $this->selectedAdviser);
                })->when($this->selectedClient, function ($query) {
                    $query->where('client_id', $this->selectedClient);
                })->when($this->selectedAward, function ($query) {
                    $query->where('award_id', $this->selectedAward);
                })->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_submitted', $this->selectedYear);
                });
            });

            $categories = $categoriesQuery->pluck('name', 'id');

            $clientsQuery = Client::whereHas('researches', function ($query) {
                $query->when($this->selectedDepartment, function ($query) {
                    $query->where('department_id', $this->selectedDepartment);
                })->when($this->selectedAdviser, function ($query) {
                    $query->where('adviser_id', $this->selectedAdviser);
                })->when($this->selectedCategory, function ($query) {
                    $query->where('category_id', $this->selectedCategory);
                })->when($this->selectedAward, function ($query) {
                    $query->where('award_id', $this->selectedAward);
                })->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_submitted', $this->selectedYear);
                });
            });

            $clients = $clientsQuery->pluck('name', 'id');

            $awardsQuery = Award::whereHas('researches', function ($query) {
                $query->when($this->selectedDepartment, function ($query) {
                    $query->where('department_id', $this->selectedDepartment);
                })->when($this->selectedAdviser, function ($query) {
                    $query->where('adviser_id', $this->selectedAdviser);
                })->when($this->selectedCategory, function ($query) {
                    $query->where('category_id', $this->selectedCategory);
                })->when($this->selectedClient, function ($query) {
                    $query->where('client_id', $this->selectedClient);
                })->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_submitted', $this->selectedYear);
                });
            });

            $awards = $awardsQuery->pluck('name', 'id');

            $latestPublished = Research::where('published', true)
                ->when($this->selectedDepartment, function ($query) {
                    $query->where('department_id', $this->selectedDepartment);
                })
                ->when($this->selectedAdviser, function ($query) {
                    $query->where('adviser_id', $this->selectedAdviser);
                })
                ->when($this->selectedCategory, function ($query) {
                    $query->where('category_id', $this->selectedCategory);
                })
                ->max('date_submitted');

            $earliestPublished = Research::where('published', true)
                ->when($this->selectedDepartment, function ($query) {
                    $query->where('department_id', $this->selectedDepartment);
                })
                ->when($this->selectedAdviser, function ($query) {
                    $query->where('adviser_id', $this->selectedAdviser);
                })
                ->when($this->selectedCategory, function ($query) {
                    $query->where('category_id', $this->selectedCategory);
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

            $researches = Research::with(['department', 'award'])
                ->where('published', true)
                ->when($this->selectedDepartment, function ($query) {
                    $query->where('department_id', $this->selectedDepartment);
                })
                ->when($this->selectedAdviser, function ($query) {
                    $query->where('adviser_id', $this->selectedAdviser);
                })
                ->when($this->selectedCategory, function ($query) {
                    $query->where('category_id', $this->selectedCategory);
                })
                ->when($this->selectedClient, function ($query) {
                    $query->where('client_id', $this->selectedClient);
                })
                ->when($this->selectedAward, function ($query) {
                    $query->where('award_id', $this->selectedAward);
                })
                ->when($this->selectedYear, function ($query) {
                    $query->whereYear('date_submitted', $this->selectedYear);
                })
                ->latest('date_submitted')
                ->paginate(6);
        } else {
            $researches = Research::search(trim($this->search))
                ->query(function ($query) {
                    $query->leftJoin('departments', 'researches.department_id', '=', 'departments.id')
                        ->leftJoin('advisers', 'researches.adviser_id', '=', 'advisers.id')
                        ->leftJoin('categories', 'researches.category_id', '=', 'categories.id')
                        ->leftJoin('clients', 'researches.client_id', '=', 'clients.id')
                        ->leftJoin('awards', 'researches.award_id', '=', 'awards.id')
                        ->select(
                            'researches.*',
                            'departments.name as department_name',
                        )
                        ->with(['department', 'award'])
                        ->where('published', true)
                        ->latest('date_submitted');
                })
                ->paginate(6);

            return view('livewire.researches.all-researches', compact('researches'));
        }

        return view('livewire.researches.all-researches', compact('researches', 'departments', 'advisers', 'categories', 'clients', 'awards', 'years'))
            ->title('Researches - DLL-CRDS');
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

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatedSelectedClient()
    {
        $this->resetPage();
    }

    public function updatedSelectedAward()
    {
        $this->resetPage();
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }
}
