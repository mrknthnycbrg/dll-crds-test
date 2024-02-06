<?php

namespace App\Livewire\Home;

use App\Models\Research;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $latestResearches = Research::with('department')
            ->where('published', true)
            ->latest('date_submitted')
            ->take(6)
            ->get();

        return view('livewire.home.home-page', compact('latestResearches'))
            ->layout('layouts.app')
            ->title('Home - DLL-CRDS');
    }
}
