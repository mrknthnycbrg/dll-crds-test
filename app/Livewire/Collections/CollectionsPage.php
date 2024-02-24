<?php

namespace App\Livewire\Collections;

use App\Models\Department;
use Livewire\Component;

class CollectionsPage extends Component
{
    public function render()
    {
        $departments = Department::with(['researches' => function ($query) {
            $query->where('published', true)->latest('date_submitted');
        }])->get();

        return view('livewire.collections.collections-page', compact('departments'))
            ->title('Collections - DLL-CRDS');
    }
}
