<?php

namespace App\Livewire\Researches;

use App\Models\Research;
use Livewire\Component;

class LatestResearches extends Component
{
    public function render()
    {
        $latestResearches = Research::with('department')
            ->where('published', true)
            ->latest('date_submitted')
            ->take(6)
            ->get();

        return view('livewire.researches.latest-researches', compact('latestResearches'));
    }
}
