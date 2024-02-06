<?php

namespace App\Livewire\Components;

use App\Models\Research;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    public function render()
    {
        $researches = [];

        if (! empty($this->search)) {
            $researches = Research::search(trim($this->search))
                ->query(function ($query) {
                    $query->join('departments', 'researches.department_id', '=', 'departments.id')
                        ->join('advisers', 'researches.adviser_id', '=', 'advisers.id')
                        ->select('researches.*', 'departments.name', 'advisers.name')
                        ->with('department')
                        ->where('published', true)
                        ->latest('date_submitted');
                })
                ->paginate(6);
        }

        return view('livewire.components.search', compact('researches'));
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
