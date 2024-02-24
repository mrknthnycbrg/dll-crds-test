<?php

namespace App\Livewire\Researches;

use App\Models\Department;
use App\Models\Research;
use Livewire\Component;

class LatestResearches extends Component
{
    public function render()
    {
        $departments = Department::with('researches')->get();
        $researches = collect();

        foreach ($departments as $department) {
            $departmentResearches = Research::with('department')
                ->where('department_id', $department->id)
                ->where('published', true)
                ->latest('date_submitted')
                ->take(3)
                ->get();

            $researches = $researches->merge($departmentResearches);
        }

        return view('livewire.researches.latest-researches', compact('researches', 'departments'));
    }
}
