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
        $latestResearches = collect();

        foreach ($departments as $department) {
            $departmentResearches = Research::with('department')
                ->where('published', true)
                ->where('department_id', $department->id)
                ->latest('date_submitted')
                ->take(3)
                ->get();

            $latestResearches = $latestResearches->merge($departmentResearches);
        }

        return view('livewire.researches.latest-researches', compact('latestResearches', 'departments'));
    }
}
