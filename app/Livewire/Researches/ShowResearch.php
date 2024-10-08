<?php

namespace App\Livewire\Researches;

use App\Models\Research;
use App\Models\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowResearch extends Component
{
    public $research;

    public function mount($slug)
    {
        $this->research = Research::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $otherResearches = Research::with('department')
            ->where('published', true)
            ->where('department_id', $this->research->department_id)
            ->where('id', '!=', $this->research->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('livewire.researches.show-research', compact('otherResearches'))
            ->title($this->research->title.' - DLL-CRDS');
    }

    public function file()
    {
        $this->redirectRoute('research-file', ['slug' => $this->research->slug]);

        View::create([
            'user' => Auth::user()->email,
            'type' => 'Research',
            'title' => $this->research->title,
            'date_viewed' => now(),
        ]);
    }
}
